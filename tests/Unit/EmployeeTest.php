<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_employee()
    {
        $request = [
            'name' => 'nama orang',
            'status_id' => '3',
            'salary' => '5000000'
        ];
        $response = $this->json('post', 'api/employees', $request);
        $response->assertStatus(201);
    }

    public function test_add_employee_already_exist_name()
    {
        $request = [
            'name' => 'nama orang',
            'status_id' => '3',
            'salary' => '5000000'
        ];
        $response = $this->json('post', 'api/employees', $request);
        $response->assertStatus(422);
    }

    public function test_add_employee_too_short_name()
    {
        $request = [
            'name' => 'n',
            'status_id' => '3',
            'salary' => '5000000'
        ];
        $response = $this->json('post', 'api/employees', $request);
        $response->assertStatus(422);
    }

    public function test_add_employee_invalid_status_id()
    {
        $request = [
            'name' => 'nama orang 1',
            'status_id' => '10',
            'salary' => '5000000'
        ];
        $response = $this->json('post', 'api/employees', $request);
        $response->assertStatus(422);
    }

    public function test_add_employee_too_low_salary()
    {
        $request = [
            'name' => 'nama orang 2',
            'status_id' => '3',
            'salary' => '500000'
        ];
        $response = $this->json('post', 'api/employees', $request);
        $response->assertStatus(422);
    }

    public function test_add_employee_too_high_salary()
    {
        $request = [
            'name' => 'nama orang 3',
            'status_id' => '3',
            'salary' => '50000000'
        ];
        $response = $this->json('post', 'api/employees', $request);
        $response->assertStatus(422);
    }

    public function test_show_employee_by_name_ascending(){
        $params = [
            'per_page' => 5,
            'page' => 1,
            'order_by' => 'name',
            'order_type' => 'ASC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(200);
    }

    public function test_show_employee_by_name_descending(){
        $params = [
            'per_page' => 5,
            'page' => 1,
            'order_by' => 'name',
            'order_type' => 'DESC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(200);
    }

    public function test_show_employee_by_salary_ascending(){
        $params = [
            'per_page' => 5,
            'page' => 1,
            'order_by' => 'salary',
            'order_type' => 'ASC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(200);
    }

    public function test_show_employee_by_salary_descending(){
        $params = [
            'per_page' => 5,
            'page' => 1,
            'order_by' => 'salary',
            'order_type' => 'DESC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(200);
    }

    public function test_show_employee_per_page_null(){
        $params = [
            'per_page' => null,
            'page' => 1,
            'order_by' => 'salary',
            'order_type' => 'ASC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(200);
    }

    public function test_show_employee_page_null(){
        $params = [
            'per_page' => 5,
            'page' => null,
            'order_by' => 'salary',
            'order_type' => 'DESC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(200);
    }

    public function test_show_employee_per_page_not_number(){
        $params = [
            'per_page' => 'a',
            'page' => 1,
            'order_by' => 'salary',
            'order_type' => 'DESC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(422);
    }

    public function test_show_employee_page_not_number(){
        $params = [
            'per_page' => 5,
            'page' => 's',
            'order_by' => 'salary',
            'order_type' => 'DESC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(422);
    }

    public function test_show_employee_order_by_invalid(){
        $params = [
            'per_page' => 5,
            'page' => 1,
            'order_by' => 'salaries',
            'order_type' => 'DESC',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(422);
    }

    public function test_show_employee_order_type_invalid(){
        $params = [
            'per_page' => 5,
            'page' => 1,
            'order_by' => 'salary',
            'order_type' => 'LEFT',
        ];
        $response = $this->json('get', 'api/employees', $params);
        $response->assertStatus(422);
    }
}
