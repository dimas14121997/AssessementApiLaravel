<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'overtime_method',
            'value' => 1,
            'expression' => '(salary / 173) * overtime_duration_total',
        ]);
    }
}
