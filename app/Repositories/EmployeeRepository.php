<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Reference;

class EmployeeRepository
{
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getPaginate($params)
    {
        $params['per_page'] = $params['per_page'] ? $params['per_page'] : 10;
        $params['page'] = $params['page'] ? $params['page'] : 1;

        $employees = $this->employee->orderBy($params['order_by'], $params['order_type']);

        $employees = $employees->paginate($params['per_page']);

        foreach($employees as $employee){
            $status = Reference::select('name')->where('id', $employee['status_id'])->first();
            $employee['status'] = $status;
        }

        return $employees;
    }

    public function store($data)
    {
        $employee = Employee::create([
            'name' => $data['name'],
            'status_id' => $data['status_id'],
            'salary' => $data['salary'],
        ]);

        return $employee;
    }
}