<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryFilesTable extends Migration
{
    public function up()
    {
        Schema::create('temporary_files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('folder');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporary_files');
    }
}
