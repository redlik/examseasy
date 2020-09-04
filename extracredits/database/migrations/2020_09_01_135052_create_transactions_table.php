<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('stripeToken');
            $table->string('name_on_card');
            $table->integer('credit_topup');
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('county');
            $table->string('country');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('coupon_id')->references('id')->on('coupons')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
