<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //社交网络
        Schema::create('social_logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 20);         //类型,weixin=微信,wxmini=小程序
            $table->string('openid', 100);      //openid
            $table->integer('member_id')->unsigned()->default(0);   //关联会员id
            $table->timestamps();
            
            $table->index(['type', 'openid']);
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_logins');
    }
}
