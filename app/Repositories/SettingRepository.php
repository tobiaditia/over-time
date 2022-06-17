<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function update($data)
    {
        $setting = Setting::first();
        $setting->key = $data['key'];
        $setting->value = $data['value'];
        $setting->save();
        return $setting;
    }
}
