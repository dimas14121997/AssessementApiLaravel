<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_setting_change_method()
    {
        $request = [
            'key' => 'overtime_method',
            'value' => '2',
        ];
        $response = $this->json('patch', 'api/settings', $request);

        $response->assertStatus(200);
    }

    public function test_setting_invalid_key(){
        $request = [
            'key' => 'overtime_methsod',
            'value' => '2',
        ];
        $response = $this->json('patch', 'api/settings', $request);

        $response->assertStatus(422);
    }

    public function test_setting_invalid_value(){
        $request = [
            'key' => 'overtime_method',
            'value' => '3',
        ];
        $response = $this->json('patch', 'api/settings', $request);

        $response->assertStatus(422);
    }
}
