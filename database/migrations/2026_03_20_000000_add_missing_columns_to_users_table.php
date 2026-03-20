<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'balance')) {
                $table->double('balance', 20, 2)->default(0);
            }
            if (!Schema::hasColumn('users', 'code')) {
                $table->string('code')->nullable();
            }
            if (!Schema::hasColumn('users', 'vip_level')) {
                $table->integer('vip_level')->default(0);
            }
            if (!Schema::hasColumn('users', 'investor')) {
                $table->integer('investor')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'phone', 'balance', 'code', 'vip_level', 'investor']);
        });
    }
};
