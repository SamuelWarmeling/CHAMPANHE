<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateLogoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->update([
            'logo'    => '/images/logo-emi.png',
            'favicon' => '/images/logo-emi.png',
        ]);
    }
}
