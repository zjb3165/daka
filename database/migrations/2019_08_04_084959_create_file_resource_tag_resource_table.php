<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileResourceTagResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_resource_tags_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resource_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            $table->index('resource_id');
            $table->index('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_resource_tags_resources');
    }
}
