<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // ── EXP Series ───────────────────────────────────────────────
            [
                'name'                       => 'EXP I – Champagne Moët',
                'title'                      => 'Experiência de entrada no mundo dos champagnes premium.',
                'photo'                      => '/v2/img/product/stable.png',
                'price'                      => 50,
                'code'                       => Str::uuid(),
                'validity'                   => 3,       // 3 dias
                'package_commission'         => 50,
                'commission_with_avg_amount' => 25,      // retorno 75 − preço 50
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'fixed',
                'vip_level'                  => 0,
                'max_purchase_limit'         => 10,
                'status'                     => 'active',
                'is_default'                 => '1',
            ],
            [
                'name'                       => 'EXP II – Champagne Veuve',
                'title'                      => 'Uma experiência refinada com Veuve Clicquot.',
                'photo'                      => '/v2/img/product/stable.png',
                'price'                      => 100,
                'code'                       => Str::uuid(),
                'validity'                   => 7,       // 7 dias
                'package_commission'         => 40,
                'commission_with_avg_amount' => 40,      // retorno 140 − preço 100
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'fixed',
                'vip_level'                  => 0,
                'max_purchase_limit'         => 10,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            [
                'name'                       => 'EXP III – Champagne Taittinger',
                'title'                      => 'Elegância e tradição da Maison Taittinger.',
                'photo'                      => '/v2/img/product/stable.png',
                'price'                      => 200,
                'code'                       => Str::uuid(),
                'validity'                   => 30,      // 30 dias
                'package_commission'         => 50,
                'commission_with_avg_amount' => 100,     // retorno 300 − preço 200
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'fixed',
                'vip_level'                  => 0,
                'max_purchase_limit'         => 10,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            [
                'name'                       => 'EXP IV – Champagne Bollinger',
                'title'                      => 'Experiência de luxo com o renomado Bollinger.',
                'photo'                      => '/v2/img/product/stable.png',
                'price'                      => 500,
                'code'                       => Str::uuid(),
                'validity'                   => 30,      // 30 dias
                'package_commission'         => 60,
                'commission_with_avg_amount' => 300,     // retorno 800 − preço 500
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'fixed',
                'vip_level'                  => 1,
                'max_purchase_limit'         => 10,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            [
                'name'                       => 'EXP V – Champagne Cristal',
                'title'                      => 'O ápice da experiência: Louis Roederer Cristal.',
                'photo'                      => '/v2/img/product/welfare.png',
                'price'                      => 5000,
                'code'                       => Str::uuid(),
                'validity'                   => 30,      // 30 dias
                'package_commission'         => 70,
                'commission_with_avg_amount' => 3500,    // retorno 8500 − preço 5000
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'welfare',
                'vip_level'                  => 2,
                'max_purchase_limit'         => 5,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            // ── Harmonie Series ──────────────────────────────────────────
            [
                'name'                       => 'Harmonie I – Perrier-Jouët',
                'title'                      => 'Harmonia entre investimento e prazer enogastronômico.',
                'photo'                      => '/v2/img/product/welfare.png',
                'price'                      => 1000,
                'code'                       => Str::uuid(),
                'validity'                   => 30,      // 30 dias
                'package_commission'         => 80,
                'commission_with_avg_amount' => 800,     // retorno 1800 − preço 1000
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'welfare',
                'vip_level'                  => 1,
                'max_purchase_limit'         => 5,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            [
                'name'                       => 'Harmonie II – Ruinart',
                'title'                      => 'Experiência ampliada com curadoria exclusiva de vinhos.',
                'photo'                      => '/v2/img/product/welfare.png',
                'price'                      => 2000,
                'code'                       => Str::uuid(),
                'validity'                   => 30,      // 30 dias
                'package_commission'         => 90,
                'commission_with_avg_amount' => 1800,    // retorno 3800 − preço 2000
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'welfare',
                'vip_level'                  => 1,
                'max_purchase_limit'         => 5,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            [
                'name'                       => 'Harmonie III – Dom Pérignon',
                'title'                      => 'Nível premium de harmonia com retornos expressivos.',
                'photo'                      => '/v2/img/product/activity.png',
                'price'                      => 3000,
                'code'                       => Str::uuid(),
                'validity'                   => 40,      // 40 dias
                'package_commission'         => 100,
                'commission_with_avg_amount' => 3000,    // retorno 6000 − preço 3000
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'activity',
                'vip_level'                  => 2,
                'max_purchase_limit'         => 3,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
            [
                'name'                       => 'Harmonie IV – Krug',
                'title'                      => 'O mais alto nível Harmonie: retorno de 120% sobre o investimento.',
                'photo'                      => '/v2/img/product/activity.png',
                'price'                      => 5000,
                'code'                       => Str::uuid(),
                'validity'                   => 40,      // 40 dias
                'package_commission'         => 120,
                'commission_with_avg_amount' => 6000,    // retorno 11000 − preço 5000
                'sponsor_income'             => 0,
                'first_ref'                  => 7,
                'second_ref'                 => 3,
                'third_ref'                  => 1,
                'category'                   => 'activity',
                'vip_level'                  => 2,
                'max_purchase_limit'         => 3,
                'status'                     => 'active',
                'is_default'                 => '0',
            ],
        ];

        foreach ($packages as $pkg) {
            $pkg['updated_at'] = now();
            DB::table('packages')->updateOrInsert(
                ['name' => $pkg['name']],
                array_merge($pkg, ['created_at' => now()])
            );
        }
    }
}
