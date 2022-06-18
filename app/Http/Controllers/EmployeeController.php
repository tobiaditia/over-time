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

    /**
    * @OA\Post(
    *      path="/employees",
    *      operationId="storeEmployee",
    *      tags={"Employee"},
    *      summary="Store new employee",
    *      description="Returns employee data",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(ref="#/components/schemas/Employee")
    *      ),
    *      @OA\Response(
    *          response=201,
    *          description="Success",
    *          @OA\JsonContent(ref="#/components/schemas/Employee")
    *      ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request",
    *          @OA\JsonContent(
    *              @OA\Property(
    *                  property="message",
    *                  type="string",
    *                  example="Validation Error"
    *             ),
    *             @OA\Property(
    *                  property="errors",
    *                  type="array",
    *                  @OA\Items(
    *                      type="object",
    *                      @OA\Property(
    *                          property="message",
    *                          type="string",
    *                          example="The name has already been taken"
    *                      ),
    *                  ),
    *             ),
    *         ),
    *      ),
    *      @OA\Response(
    *          response=500,
    *          description="Server Error",
    *          @OA\JsonContent(
    *              @OA\Property(
    *                  property="message",
    *                  type="string",
    *                  example="Server Error"
    *             ),
    *             @OA\Property(
    *                  property="errors",
    *                  type="string",
    *                  nullable=true
    *             ),
    *         ),
    *      ),
    * )
    */
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
