<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code'  => 'jne',
                'title' => 'JNE'
            ],
            [
                'code'  => 'pos',
                'title' => 'POS'
            ],
            [
                'code'  => 'tiki',
                'title' => 'TIKI'
            ],
        ];

        DB::table('couriers')->insert($data);
    }
}
