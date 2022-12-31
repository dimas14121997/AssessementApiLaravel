<?php

namespace App\Repositories;

use App\Models\Reference;
use App\Models\Setting;

class SettingRepository{

    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function changeMethod($data){
        $expression = Reference::find($data['value']);
        $setting = Setting::where('id', 1)->update([
            'key' => $data['key'],
            'value' => $data['value'],
            'expression' => $expression['expression']
        ]);
    }
}
