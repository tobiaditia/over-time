<?php

namespace App\Http\Controllers;

use App\Services\SettingServices;
use Illuminate\Http\Request;
use App\Utils\Response;

class SettingController extends Controller
{
     use Response;
    protected $settingServices;

    public function __construct(SettingServices $settingServices) {
        $this->settingServices = $settingServices;
    }
    /**
    * @OA\Patch(
    *      path="/api/settings",
    *      operationId="updateSetting",
    *      tags={"Setting"},
    *      summary="Update settings",
    *      description="Returns settings data",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(ref="#/components/schemas/Setting")
    *      ),
    *      @OA\Response(
    *          response=201,
    *          description="Success",
    *          @OA\JsonContent(ref="#/components/schemas/Setting")
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
    public function update(Request $request)
    {
        try {
            $setting = $this->settingServices->updateSetting($request->only([
                'key',
                'value',
            ]));
            return $setting;
        } catch (\Throwable $th) {
            return $this->responseServerError();
        }

    }
}
