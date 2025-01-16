<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PayrollRequest;
use Carbon\Carbon;
use App\Models\Payroll;
use App\Services\PayrollService;
use App\Http\Resources\PayrollResource;

class PayrollController extends Controller
{
    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    /**
     * Get the payroll information for a given year and month.
     *
     * This endpoint accepts optional year and month parameters to calculate payroll dates.
     * If no parameters are provided, it defaults to the current year and month.
     * The response includes both the payday (last business day of month) and
     * the actual payment date (accounting for bank processing days).
     *
     * @param  \App\Http\Requests\PayrollRequest  $request
     * @return \App\Http\Resources\PayrollResource
     */
    public function index(PayrollRequest $request): PayrollResource
    {
        $validated = $request->validated();

        $year  = $validated['year'] ?? now()->year;
        $month = $validated['month'] ?? now()->month;

        $payroll = $this->payrollService->generatePayroll(year: $year, month: $month);


        return new PayrollResource($payroll);
    }
}
