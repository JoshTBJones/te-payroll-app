<?php

namespace App\Models;

use Carbon\Carbon;

class Payroll
{
    protected $payday;
    protected $paymentDate;

 

    /**
     * Constructor for the Payroll class.
     *
     * @param int $month The month for which payroll is being calculated
     * @param int $year The year for which payroll is being calculated
     */
    public function __construct(Carbon $payday, Carbon $paymentDate)
    {
        $this->payday = $payday;
        $this->paymentDate = $paymentDate;
    }

    /**
     * Get the payday date.
     *
     * @return \Carbon\Carbon The calculated payday date
     */
    public function getPayday(): Carbon
    {
        return $this->payday;
    }

    /**
     * Get the payment date.
     *
     * @return \Carbon\Carbon The calculated payment date after bank transfer delay
     */
    public function getPaymentDate(): Carbon
    {
        return $this->paymentDate;
    }
}
