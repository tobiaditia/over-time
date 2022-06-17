<?php

namespace App\Services;

use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\Validator;
use App\Utils\Response;

class SettingServices{
    use Response;
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository) {
        $this->settingRepository = $settingRepository;
    }

    public function updateSetting($data) {
        $validator = Validator::make($data, [
            'key' => 'required|in:overtime_method',
            'value' => 'required|exists:references,id',
        ]);

        if ($validator->fails()) {
           return $this->responseValidation($validator->errors()->all());
        }

        return $this->settingRepository->update($data);
    }
}
