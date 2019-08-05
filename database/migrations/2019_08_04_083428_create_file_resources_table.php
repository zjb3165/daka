<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->enum('category', ['image', 'audio', 'video', 'files']);
            $table->string('path', 150);
            $table->string('src_path', 150);
            $table->integer('size')->unsigned()->default(0);
            $table->string('cover', 150)->default('');
            $table->integer('duration')->unsigned()->default(0);
            $table->string('mime')->default('');
            $table->integer('status')->unsigned()->default(1);
            $table->timestamps();

            $table->index(['category', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_resources');
    }
}
