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
        Schema::create('user_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('get_balance_from_user_id')->nullable();
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->string('reason');
            $table->string('perticulation')->nullable();
            $table->double('amount', 20, 2)->default(0);
            $table->double('debit', 20, 2)->default(0);
            $table->double('credit', 20, 2)->default(0);
            $table->string('step')->nullable();
            $table->string('date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'default'])->default('default');
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
        Schema::dropIfExists('user_ledgers');
    }
};
