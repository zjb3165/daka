<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberLoginRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_login_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->unsigned();   //登录会员id
            $table->string('type', 30);                 //登录方式 web=网页, chat=公众号窗口
            $table->string('source');                   //登录页面
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
        Schema::dropIfExists('member_login_records');
    }
}
