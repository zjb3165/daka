<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsQrTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->unsigned();
            $table->string('ticket', 200);       //微信二维码ticket
            $table->string('locale', 100);  //本地图片
            $table->string('remote');       //远程图片
            $table->integer('expired_at')->unsigned()->default(0);  //过期时间
            $table->timestamps();
            
            $table->index(['member_id', 'ticket']);
            $table->index('ticket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qr_tickets');
    }
}
