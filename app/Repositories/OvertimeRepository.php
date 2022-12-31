<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Reference;
use App\Models\Setting;

class OvertimeRepository
{
    protected $overtime;

    public function __construct(Overtime $overtime)
    {
        $this->overtime = $overtime;
    }

    public function store($data)
    {
        $overtime = Overtime::create([
            'employee_id' => $data['employee_id'],
            'date' => $data['date'],
            'time_started' => $data['time_started'],
            'time_ended' => $data['time_ended']
        ]);

        return $overtime;
    }

    public function showByRange($data)
    {
        $overtimes = Overtime::whereBetween('date', [$data['date_started'], $data['date_ended']])
            ->orderBy('date')->get();

        foreach ($overtimes as $overtime) {
            $employee = Employee::select('name')->where('id', $overtime['employee_id'])->first();
            $overtime['employee'] = $employee;
        }

        return $overtimes;
    }

    public function calculatePays($data)
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $status = Reference::select('name')->where('id', $employee['status_id'])->first();
            $employee['status'] = $status;

            $overtimes = Overtime::where('employee_id', $employee->id)->where('date', 'like', $data['month'] . '%')
                ->select(['id', 'date', 'time_started', 'time_ended'])->get();

            $duration_total = 0;
            foreach ($overtimes as $overtime) {
                $duration = ((strtotime($overtime['time_ended']) - strtotime($overtime['time_started'])) / 3600);
                if ($employee['status']->name === 'Percobaan') {
                    $duration = $duration - 1;
                    if ($duration < 0)
                        $duration = 0;
                }
                $duration = round($duration);
                $overtime['overtime_duration'] = $duration;
                $duration_total += $duration;
            }
            $employee['overtimes'] = $overtimes;
            $employee['overtime_duration_total'] = $duration_total;
            $salary = $employee['salary'];
            $amount = 0;

            $overtime_method = Setting::select('expression')->where('key', 'overtime_method')->first();
            $expression = $overtime_method->expression;
            $expression = str_replace('salary', $salary, $expression);
            $expression = str_replace('overtime_duration_total', $duration_total, $expression);

            eval('$employee["amount"] = ' . $expression . ';');
        }

        return $employees;
    }
}
