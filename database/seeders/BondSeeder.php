<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('bonds')->insert([
            ['issue_date' => '2021-11-08', 'last_circulation_date' => '2022-12-30', 'nominal_price' => 100, 'coupon_payout_frequency' => '4','interest_calculation_period'=>'360','coupon_interest'=>10],
            ['issue_date' => '2021-11-08', 'last_circulation_date' => '2022-12-30', 'nominal_price' => 200, 'coupon_payout_frequency' => '4','interest_calculation_period'=>'364','coupon_interest'=>20],
            ['issue_date' => '2021-11-08', 'last_circulation_date' => '2022-12-31', 'nominal_price' => 300, 'coupon_payout_frequency' => '4','interest_calculation_period'=>'365','coupon_interest'=>30],

        ]);
    }
}
