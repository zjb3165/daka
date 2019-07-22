<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname', 100)->default('');       //昵称
            $table->string('avatar', 255)->default('');         //头像
            $table->string('phone', 30)->default('');           //手机
            $table->integer('parent_id')->unsigned()->default(0);   //推荐人id
            $table->tinyInteger('gender')->default(0);          //性别
            $table->integer('birthday')->unsigned()->default(0);    //出生年月
            $table->integer('credits')->unsigned()->default(0);     //积分
            $table->integer('balance')->unsigned()->default(0);     //余额
            $table->integer('subscribed_at')->unsigned()->default(0);   //关注公众号时间，0未关注
            $table->integer('actived_at')->unsigned()->default(0);  //最后活跃时间
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
        Schema::dropIfExists('members');
    }
}
