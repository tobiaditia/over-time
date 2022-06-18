<?php

namespace App\Http\Controllers;

use App\Services\Overtime2Services;
use Illuminate\Http\Request;
use App\Utils\Response;

class OvertimeController extends Controller
{
    use Response;
    protected $overtimeServices;

    public function __construct(Overtime2Services $overtimeServices) {
        $this->overtimeServices = $overtimeServices;
    }

    /**
    * @OA\Post(
    *      path="/api/overtimes",
    *      operationId="storeOvertime",
    *      tags={"Overtime"},
    *      summary="Store new employee",
    *      description="Returns employee data",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(ref="#/components/schemas/Overtime")
    *      ),
    *      @OA\Response(
    *          response=201,
    *          description="Success",
    *          @OA\JsonContent(ref="#/components/schemas/Overtime")
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
    *                          example="The time started must be a date before time ended."
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

    /**
    * @OA\Get(
    *      path="/api/overtime-pays/calculate",
    *      operationId="calculateOvertime",
    *      tags={"Overtime"},
    *      summary="Calculate employee salary",
    *      description="Returns employee data",
    *      @OA\Parameter(
    *         name="month",
    *         in="query",
    *         description="month",
    *         required=true,
    *         @OA\Schema(
    *            type="string",
    *            format="date",
    *            example="2022-06"
    *         )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Success",
    *          @OA\JsonContent(
    *              @OA\Property(
    *                  type="array",
    *                  @OA\Items(
    *                      type="object",
    *                      @OA\Property(
    *                          property="id",
    *                          type="integer",
    *                          example=1
    *                      ),
    *                      @OA\Property(
    *                          property="name",
    *                          type="string",
    *                          example="tobi"
    *                      ),
    *                      @OA\Property(
    *                          property="salary",
    *                          type="integer",
    *                          example=2000000
    *                      ),
    *                      @OA\Property(
    *                          property="overtimes",
    *                          type="array",
    *                          @OA\Items(
    *                               type="object",
    *                               @OA\Property(
    *                                   property="id",
    *                                   type="integer",
    *                                   example=1
    *                               ),
    *                               @OA\Property(
    *                                   property="date",
    *                                   type="string",
    *                                   example="2022-06"
    *                               ),
    *                               @OA\Property(
    *                                   property="time_started",
    *                                   type="string",
    *                                   example="19:00"
    *                               ),
    *                               @OA\Property(
    *                                   property="time_ended",
    *                                   type="string",
    *                                   example="20:00"
    *                               ),
    *                               @OA\Property(
    *                                   property="overtime_duration",
    *                                   type="string",
    *                                   example="2"
    *                               ),
    *                           ),
    *                      ),
    *                      @OA\Property(
    *                          property="overtime_duration_total",
    *                          type="integer",
    *                          example=20
    *                      ),
    *                      @OA\Property(
    *                          property="amount",
    *                          type="integer",
    *                          example=10000000
    *                      ),
    *                  ),
    *             ),
    *         ),
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
    *                          example="The time started must be a date before time ended."
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
