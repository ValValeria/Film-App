<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_product', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description');
            $table->string('long_description',300);
            $table->string('image');
            $table->string('price');
            $table->json("ingredients");
            $table->string('weight');
            $table->enum('category',["пицца","салаты"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_product');
    }
}
