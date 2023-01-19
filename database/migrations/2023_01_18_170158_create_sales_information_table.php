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
        Schema::create('sales_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->comment('店舗ID');
            $table->time('start_business')->nullable()->comment('営業開始時間');
            $table->time('end_business')->nullable()->comment('営業終了時間');
            $table->text('time_remarks', 3000)->nullable()->comment('営業時間に関する備考');
            $table->integer('regular_holiday')->nullable()->default(0)->comment('0: 休みなし, 1: 月曜日, 2: 火曜日, 3: 水曜日, 4: 木曜日, 5: 金曜日, 6: 土曜日, 7: 日曜日');
            $table->text('regular_holiday_remarks', 3000)->nullable()->comment('定休日に関する備考');
            $table->time('late_reserve')->nullable()->default(null)->comment('最遅予約可能時間');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('restaurant_informations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('営業情報テーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_information');
    }
};
