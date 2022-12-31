<?php

namespace App\Services;

use App\Models\Reference;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use InvalidArgumentException;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getPaginate($params)
    {
        $validator = Validator::make($params, [
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
            'order_by' => ['required', 'string', new Enum('name', 'salary')],
            'order_type' => ['required', 'string', new Enum('ASC', 'DESC')]
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $validator['per_page'] = $validator['per_page'] !== null ? $validator['per_page'] : 10;
        $validator['page'] = $validator['page'] !== null ? $validator['page'] : 10;

        return $this->employeeRepository->getPaginate($params);
    }

    public function store($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:employees,name',
            'status_id' => ['required', 'integer', Rule::exists('references', 'id')->where('code', 'employee_status')],
            'salary' => 'required|integer|min:2000000|max:10000000',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
    }
}
