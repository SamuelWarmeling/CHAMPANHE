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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_name')->nullable();
            $table->string('site_title')->nullable();
            $table->double('registration_bonus', 20, 2)->default(0);
            $table->double('minimum_withdraw', 20, 2)->default(0);
            $table->double('maximum_withdraw', 20, 2)->default(0);
            $table->double('withdraw_charge', 20, 2)->default(0);
            $table->tinyInteger('open_transfer')->default(0);
            $table->tinyInteger('auto_transfer')->default(0);
            $table->string('auto_transfer_default')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
