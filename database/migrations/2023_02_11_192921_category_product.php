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
        Schema::create("category_product", function(Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")
            ->unsigned()
            ->constrained()
            ->onDelete("cascade");
            $table->foreignId("product_id")
            ->unsigned()
            ->constrained()
            ->onDelete("cascade");
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
        //
    }
};
