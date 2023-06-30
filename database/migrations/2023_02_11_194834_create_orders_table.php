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
            $table->string("order_number"); // Unique number for each order done by user. Multiple orders may associated to the single number
            $table->foreignId("user_id")
                        ->unsigned()
                        ->constrained()
                        ->onDelete("cascade");
            $table->foreignId("product_id")
                        ->unsigned()
                        ->constrained()
                        ->onDelete("cascade");
            $table->decimal("grand_total", 10, 2);
            $table->string("payment_method", 50);
            $table->string("status");
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
