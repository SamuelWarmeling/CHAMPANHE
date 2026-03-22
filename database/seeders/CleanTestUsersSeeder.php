<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanTestUsersSeeder extends Seeder
{
    /**
     * Remove test/duplicate users that cause unique constraint conflicts.
     * Safe to run multiple times (idempotent).
     */
    public function run(): void
    {
        // Known test phone numbers from development/testing
        $testPhones = [
            '91984700431',
        ];

        $deleted = DB::table('users')
            ->whereIn('phone', $testPhones)
            ->delete();

        if ($deleted > 0) {
            $this->command->info("CleanTestUsersSeeder: removed {$deleted} test user(s).");
        } else {
            $this->command->info('CleanTestUsersSeeder: no test users found.');
        }
    }
}
