<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Payroll;

class PayrollService
{
   /**
     * The number of business days it takes for the bank to process the payment.
     *
     * This constant represents the standard delay between when payroll is calculated
     * and when the actual bank transfer is processed and funds become available.
     *
     * @var int
     */
    private const BANK_PROCESSING_DAYS = 4;

    /**
     * Generate a payroll object for a given year and month.
     * 
     * This method calculates both the payday (last business day of the month)
     * and the actual payment date (accounting for bank processing days).
     *
     * @param int $year The year to generate payroll for
     * @param int $month The month to generate payroll for (1-12)
     * @return \App\Models\Payroll The payroll object
     */
    public function generatePayroll(int $year, int $month): Payroll
    {
        $payday = $this->calculatePayday($year, $month);
        $paymentDate = $this->calculatePaymentDate($payday, self::BANK_PROCESSING_DAYS);

        return new Payroll($payday, $paymentDate);
    }

    /**
     * Calculate the payday for a given year and month.
     * The payday is typically the second to  last business day of the month.
     * If the last day falls on a weekend, it will be adjusted to the previous Friday.
     *
     * @param int $year The year to calculate payday for
     * @param int $month The month to calculate payday for (1-12)
     * @return \Carbon\Carbon The calculated payday as a Carbon instance
     */
    public function calculatePayday(int $year, int $month): Carbon
    {
        $payday = Carbon::create($year, $month)->endOfMonth()->startOfDay()->subDays(1);

        // If payday is a weekend, adjust to the previous Friday
        if ($payday->isWeekend()) {
            $payday->subDays($payday->dayOfWeek === Carbon::SATURDAY ? 1 : 2);
        }

        return $payday;
    }

    /**
     * Calculate the payment date by subtracting working days from the payday.
     * Weekends are skipped in the calculation of working days.
     *
     * @param \Carbon\Carbon $payday The payday to calculate payment date from
     * @param int $days Number of working days to subtract
     * @return \Carbon\Carbon The calculated payment date as a Carbon instance
     */
    public function calculatePaymentDate(Carbon $payday, int $days): Carbon
    {
        $paymentDate = $payday->copy();

        // Subtract working days (skip weekends)
        for ($i = 0; $i < $days; $i++) {
            $paymentDate->subDay();
            if ($paymentDate->isWeekend()) {
                $i--; // Ignore weekends in the calculation
            }
        }

        return $paymentDate;
    }
}
