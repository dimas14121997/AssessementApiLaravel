<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_overtime()
    {
        $request = [
            'employee_id' => 1,
            'date' => '2022-04-11',
            'time_started' => '09:34',
            'time_ended' => '15:21',
        ];
        $response = $this->json('post', 'api/overtimes', $request);
        $response->assertStatus(200);
    }

    public function test_add_overtime_employee_invalid()
    {
        $request = [
            'employee_id' => 10,
            'date' => '2022-04-11',
            'time_started' => '09:34',
            'time_ended' => '15:21',
        ];
        $response = $this->json('post', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_add_overtime_date_invalid()
    {
        $request = [
            'employee_id' => 1,
            'date' => '11-04-2022',
            'time_started' => '09:34',
            'time_ended' => '15:21',
        ];
        $response = $this->json('post', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_add_overtime_time_started_invalid()
    {
        $request = [
            'employee_id' => 1,
            'date' => '2022-04-11',
            'time_started' => 'pagi',
            'time_ended' => '15:21',
        ];
        $response = $this->json('post', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_add_overtime_time_ended_invalid()
    {
        $request = [
            'employee_id' => 1,
            'date' => '2022-04-11',
            'time_started' => '03:21',
            'time_ended' => 'sore',
        ];
        $response = $this->json('post', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_add_overtime_time_inversed()
    {
        $request = [
            'employee_id' => 1,
            'date' => '2022-04-11',
            'time_started' => '15:21',
            'time_ended' => '09:34',
        ];
        $response = $this->json('post', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_show_overtime()
    {
        $request = [
            'date_started' => '2022-04-10',
            'date_ended' => '2022-04-12',
        ];
        $response = $this->json('get', 'api/overtimes', $request);
        $response->assertStatus(200);
    }

    public function test_show_overtime_date_started_invalid()
    {
        $request = [
            'date_started' => '100-04-2022',
            'date_ended' => '2022-04-12',
        ];
        $response = $this->json('get', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_show_overtime_date_ended_invalid()
    {
        $request = [
            'date_started' => '2022-04-10',
            'date_ended' => '100-04-20222',
        ];
        $response = $this->json('get', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_show_overtime_date_inversed()
    {
        $request = [
            'date_started' => '2022-04-10',
            'date_ended' => '2022-04-08',
        ];
        $response = $this->json('get', 'api/overtimes', $request);
        $response->assertStatus(422);
    }

    public function test_overtime_calculate(){
        $request = [
            'month' => '2022-04'
        ];
        $response = $this->json('get', 'api/overtime-pays/calculate', $request);
        $response->assertStatus(200);
    }

    public function test_overtime_calculate_month_invalid(){
        $request = [
            'month' => '04-2022'
        ];
        $response = $this->json('get', 'api/overtime-pays/calculate', $request);
        $response->assertStatus(422);
    }
}
