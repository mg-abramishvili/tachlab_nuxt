<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryProductTable extends Migration
{
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('product_id');
        });
    }

    public function down()
    {
        //
    }
}
