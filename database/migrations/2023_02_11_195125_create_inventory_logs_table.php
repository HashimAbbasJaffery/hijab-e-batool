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
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")
                    ->unsigned()
                    ->constrained()
                    ->onDelete("cascade");
            $table->integer("new_qty");
            $table->string("reason");
            $table->foreignId("employee_id")
                    ->unsigned()
                    ->constrained()
                    ->onDelete("cascade");
            $table->boolean("is_approved")->default(0);
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
        Schema::dropIfExists('inventory_logs');
    }
};
