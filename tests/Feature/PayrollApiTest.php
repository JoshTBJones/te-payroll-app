<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PayrollApiTest extends TestCase
{
    /**
     * Test that the payroll API returns correctly structured date data.
     * 
     * This test verifies that when valid year and month parameters are provided,
     * the API returns a 200 status code and JSON response containing payday
     * and payment_date fields in the expected structure.
     *
     * @return void
     */
    public function test_payroll_api_returns_correct_dates()
    {
        $response = $this->getJson('/api/payroll?year=2025&month=1');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => ['payday', 'payment_date']]);
    }

    /**
     * Test that the payroll API returns correctly structured date data without query parameters.
     * 
     * This test verifies that when no year and month parameters are provided,
     * the API defaults to the current month and year, returns a 200 status code,
     * and JSON response containing payday and payment_date fields in the expected structure.
     *
     * @return void
     */
    public function test_payroll_api_returns_correct_dates_without_query_params()
    {
        $response = $this->getJson('/api/payroll');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => ['payday', 'payment_date']]);
    }

    /**
     * Test that the payroll API returns 422 status for invalid dates.
     * 
     * This test verifies that when an invalid month (13) is provided,
     * the API returns a 422 Unprocessable Entity status code.
     *
     * @return void
     */
    public function test_payroll_api_returns_422_for_invalid_dates()
    {
        $response = $this->getJson('/api/payroll?year=2025&month=13');
        $response->assertStatus(422);
    }

    /**
     * Test that the payroll API returns 422 status for invalid year.
     * 
     * This test verifies that when a year outside the valid range (2000-2100) is provided,
     * the API returns a 422 Unprocessable Entity status code.
     *
     * @return void
     */
    public function test_payroll_api_returns_422_for_invalid_year()
    {
        $response = $this->getJson('/api/payroll?year=2250&month=1');
        $response->assertStatus(422);
    }

    /**
     * Test that the payroll API returns 422 status for invalid month.
     * 
     * This test verifies that when an invalid month number (13) is provided,
     * the API returns a 422 Unprocessable Entity status code.
     *
     * @return void
     */
    public function test_payroll_api_returns_422_for_invalid_month()
    {
        $response = $this->getJson('/api/payroll?year=2025&month=13');
        $response->assertStatus(422);
    }
}
