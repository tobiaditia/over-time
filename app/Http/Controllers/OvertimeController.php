<?php

namespace App\Http\Controllers;

use App\Http\Resources\OvertimeResource;
use App\Services\EmployeeServices;
use App\Services\Overtime2Services;
use App\Services\OvertimeServices;
use Illuminate\Http\Request;
use App\Utils\Response;

class OvertimeController extends Controller
{
    use Response;
    protected $overtimeServices;

    public function __construct(Overtime2Services $overtimeServices) {
        $this->overtimeServices = $overtimeServices;
    }

    public function store(Request $request)
    {
        try {
            $overtime = $this->overtimeServices->createOvertime($request->only([
                'employee_id',
                'date',
                'time_started',
                'time_ended',
            ]));
            return $overtime;
        } catch (\Throwable $th) {
            return $this->responseServerError();
        }

    }

    public function calculate(Request $request)
    {
        try {
            $overtime = $this->overtimeServices->calculate($request->only([
                'month',
            ]));
            return $overtime;
        } catch (\Throwable $th) {
            return $th;
            return $this->responseServerError();
        }

    }
}
