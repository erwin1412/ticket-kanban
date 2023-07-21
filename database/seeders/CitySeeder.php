<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CitySeeder extends Seeder
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
        ])->get('https://api.rajaongkir.com/starter/city');

        foreach ($response['rajaongkir']['results'] as $city) {
            DB::table('cities')->insert([
                'province_id' => $city['province_id'],
                'city_id'     => $city['city_id'],
                'title'       => $city['city_name'] . ' - ' . '(' . $city['type'] . ')',
            ]);
        }
    }
}
