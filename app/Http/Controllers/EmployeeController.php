<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeServices;
use Illuminate\Http\Request;
use App\Utils\Response;

class EmployeeController extends Controller
{
    use Response;
    protected $employeeServices;

    public function __construct(EmployeeServices $employeeServices) {
        $this->employeeServices = $employeeServices;
    }

    public function store(Request $request)
    {
        try {
            $employee = $this->employeeServices->createEmployee($request->only(['name', 'salary']));
            return $employee;
        } catch (\Throwable $th) {
            return $this->responseServerError();
        }

    }
}
