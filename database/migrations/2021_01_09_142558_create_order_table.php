<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("product_id");
            $table->integer("quantity");
            $table->enum('status',['active','unactive']);
            $table->char('location',100);
            $table->string("created_at",50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_order');
    }
}
