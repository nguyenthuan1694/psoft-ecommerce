<?php

use App\Models\District;
use App\Models\Province;
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
        Province::chunk(50, function ($provinces) {
            $provinces->each(function (Province $province) {
                District::where('parent_code', $province->code)->chunk(50, function ($districts) use ($province) {
                    $districts->each(function (District $district) use ($province) {
                        DB::table('couriers')->insert([
                            'province_code' => $province->code,
                            'district_code' => $district->code,
                            'weight' => 20,
                            'amount' => config('common.shipping.default_fee'),
                        ]);
                    });
                });
            });
        });
    }
}
