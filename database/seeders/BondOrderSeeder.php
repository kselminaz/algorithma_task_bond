<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BondOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (  DB::table('bonds')->get() as $item){

            DB::table('bond_orders')->insert([
                ['bond_id' => $item->id, 'order_date' => Carbon::parse($item->last_circulation_date)->subDays(10), 'bond_order_count' => rand(10,30)],
            ]);

        }
    }
}
