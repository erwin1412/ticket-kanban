<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.key'),
        ])->get('https://api.rajaongkir.com/starter/province');

        foreach ($response['rajaongkir']['results'] as $province) {
            DB::table('provinces')->insert([
                'province_id' => $province['province_id'],
                'title'       => $province['province']
            ]);
        }
    }
}
