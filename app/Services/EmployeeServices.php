<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;
use App\Utils\Response;

class EmployeeServices{
    use Response;
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository) {
        $this->employeeRepository = $employeeRepository;
    }

    public function createEmployee($data) {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:2|unique:employees',
            'salary' => 'required|integer|max:10000000|min:2000000',
        ]);

        if ($validator->fails()) {
           return $this->responseValidation($validator->errors()->all());
        }

        return $this->employeeRepository->save($data);
    }
}
