<?php

namespace App\Services;

use App\Http\Resources\OvertimeCalculateResource;
use App\Repositories\OvertimeRepository;
use Illuminate\Support\Facades\Validator;
use App\Utils\Response;

class Overtime2Services{
    use Response;
    protected $overtimeRepository;

    public function __construct(OvertimeRepository $overtimeRepository) {
        $this->overtimeRepository = $overtimeRepository;
    }

    public function createOvertime($data) {
        $validator = Validator::make($data, [
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'time_started' => 'required|date_format:H:i|before:time_ended',
            'time_ended' => 'required|date_format:H:i|after:time_started',
        ]);

        if ($validator->fails()) {
           return $this->responseValidation($validator->errors()->all());
        }

        return $this->overtimeRepository->save($data);
    }

    public function calculate($data) {
        $validator = Validator::make($data, [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
           return $this->responseValidation($validator->errors()->all());
        }

        $result = $this->overtimeRepository->calculate($data);
        return OvertimeCalculateResource::collection($result);
    }
}
