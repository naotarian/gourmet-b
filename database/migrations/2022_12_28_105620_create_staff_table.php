<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->comment('店舗ID');
            $table->string('name')->comment('スタッフ氏名');
            $table->integer('staff_color')->nullable()->default(1)->comment('スタッフの表示色');
            $table->integer('kind')->nullable()->default(1)->comment('スタッフの役職 => 1 : アルバイト, 2 : 正社員');
            $table->date('enter_date')->comment('入店日');
            $table->date('quit_date')->comment('辞店日');
            $table->integer('gender')->comment('性別 => 1 : 男性, 2 : 女性');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('restaurant_informations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('スタッフテーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
};
