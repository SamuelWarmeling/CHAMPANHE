<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ref_by')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('phone_code')->nullable();
            $table->string('realname')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('gateway_method')->nullable();
            $table->string('gateway_address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type')->nullable();
            $table->double('balance', 20, 2)->default(0);
            $table->double('total_income', 20, 2)->default(0);
            $table->double('today_income', 20, 2)->default(0);
            $table->string('code')->nullable();
            $table->string('ip')->nullable();
            $table->integer('vip_level')->default(0);
            $table->integer('investor')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
