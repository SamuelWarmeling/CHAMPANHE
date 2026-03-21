<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('method_name')->nullable();
            $table->string('trx')->nullable();
            $table->text('account_info')->nullable();
            $table->string('number')->nullable();
            $table->double('amount', 20, 2)->default(0);
            $table->string('currency')->default('NGN');
            $table->double('charge', 20, 2)->default(0);
            $table->double('final_amount', 20, 2)->default(0);
            $table->string('oid')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
