<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Overtime;
use Carbon\Carbon;

class OvertimeRepository
{
    public function save($data)
    {
        $overtime = new Overtime;
        $overtime->employee_id = $data['employee_id'];
        $overtime->date = Carbon::parse($data['date']);
        $overtime->time_started = $data['time_started'];
        $overtime->time_ended = $data['time_ended'];
        $overtime->save();
        return $overtime;
    }

    public function calculate($data)
    {
        $employee = Employee::with('overtime')->get();
        return $employee;
    }
}
