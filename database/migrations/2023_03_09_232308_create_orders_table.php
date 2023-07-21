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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('order_number');
            $table->string('name');
            $table->string('phone_number');
            $table->integer('weight');
            $table->string('courier');
            $table->string('service');
            $table->integer('total_price');
            $table->integer('shipping_cost');
            $table->integer('total_amount');
            $table->text('address');
            $table->enum('status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->string('snap_token')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
