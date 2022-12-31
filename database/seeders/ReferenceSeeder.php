<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Reference::create([
            'code' => 'overtime_method',
            'name' => 'Salary / 173',
            'expression' => '(salary / 173) * overtime_duration_total'
        ]);
        Reference::create([
            'code' => 'overtime_method',
            'name' => 'Fixed',
            'expression' => '10000 * overtime_duration_total'
        ]);
    }
}
