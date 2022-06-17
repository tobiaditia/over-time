<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function save($data)
    {
        $employee = new Employee;
        $employee->name = $data['name'];
        $employee->salary = $data['salary'];
        $employee->save();
        return $employee;
    }
}
