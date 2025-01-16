<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PayrollService;
use App\Models\Payroll;
use Carbon\Carbon;

class PayrollTest extends TestCase
{
    protected $payrollService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->payrollService = new PayrollService();
    }

    /**
     * Test the generatePayroll method creates a valid Payroll object.
     *
     * This test verifies that:
     * - The method returns a Payroll instance
     * - The payday is correctly set to January 30, 2025
     * - The payment date is correctly set to January 24, 2025 (4 business days before payday)
     *
     * @return void
     */
    public function testGeneratePayroll()
    {
        $year = 2025;
        $month = 1; // January

        $payroll = $this->payrollService->generatePayroll($year, $month);

        $this->assertInstanceOf(Payroll::class, $payroll);
        $this->assertEquals('2025-01-30', $payroll->getPayday()->toDateString());
        $this->assertEquals('2025-01-24', $payroll->getPaymentDate()->toDateString());
    }

    /**
     * Test the calculatePayday method returns the correct date.
     * 
     * This test verifies that:
     * - The method returns a Carbon instance
     * - The payday is correctly set to January 30, 2025 (last business day of month)
     *
     * @return void
     */
    public function testCalculatePayday()
    {
        $year = 2025;
        $month = 1; // January

        $payday = $this->payrollService->calculatePayday($year, $month);

        $this->assertInstanceOf(Carbon::class, $payday);
        $this->assertEquals('2025-01-30', $payday->toDateString());
    }

    /**
     * Test the calculatePaymentDate method returns the correct date.
     * 
     * This test verifies that:
     * - The method returns a Carbon instance
     * - The payment date is correctly calculated as 4 business days before payday
     * - Weekends are properly skipped in the calculation
     *
     * @return void
     */
    public function testCalculatePaymentDate()
    {
        $payday = Carbon::create(2025, 1, 30); // January 30, 2025
        $days = 4;

        $paymentDate = $this->payrollService->calculatePaymentDate($payday, $days);

        $this->assertInstanceOf(Carbon::class, $paymentDate);
        $this->assertEquals('2025-01-24', $paymentDate->toDateString());
    }
}
