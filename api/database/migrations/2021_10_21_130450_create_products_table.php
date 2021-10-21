<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->decimal('price')->default(0);
            $table->string('diagonal')->nullable();
            $table->string('resolution')->nullable();
            $table->boolean('is_new')->nullable();
            $table->boolean('is_popular')->nullable();
            $table->boolean('is_onsale')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
