<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RebateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rebates')->truncate();

        DB::table('rebates')->insert([
            'team_commission1'     => 7,  // Nível 1: 7%
            'team_commission2'     => 3,  // Nível 2: 3%
            'team_commission3'     => 1,  // Nível 3: 1%
            'interest_commission1' => 7,
            'interest_commission2' => 3,
            'interest_commission3' => 1,
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);
    }
}
