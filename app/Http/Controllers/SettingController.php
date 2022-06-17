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
