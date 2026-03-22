<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
            'site_name'                        => 'EMI – Enoteca Millesimi',
            'site_title'                       => 'EMI – Enoteca Millesimi | Investimentos em Experiências Premium',
            'logo'                             => '/images/logo-emi.png',
            'favicon'                          => '/images/logo-emi.png',
            'telegram'                         => '',
            'registration_bonus'               => 0,
            'minimum_withdraw'                 => 100,
            'maximum_withdraw'                 => 50000,
            'withdraw_charge'                  => 15,
            'open_transfer'                    => 1,
            'auto_transfer'                    => 0,
            'auto_transfer_default'            => null,
            'channel'                          => null,
            'open_deposit'                     => 1,
            'auto_deposit'                     => 0,
            'w_time_status'                    => 0,
            'checkin'                          => 0,
            'total_member_register_reword'     => 0,
            'total_member_register_reword_amount' => 0,
            'minimum_recharge'                 => 50,
            'maximum_recharge'                 => 100000,
            'created_at'                       => now(),
            'updated_at'                       => now(),
        ]);
    }
}
