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
        Schema::create('reserve_datas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->comment('店舗ID');
            $table->unsignedBigInteger('seat_id')->comment('座席ID');
            $table->string('reserve_number', 128)->comment('予約番号');
            $table->date('reserve_date')->comment('予約日');
            $table->time('reserve_time')->comment('予約時間');
            $table->dateTime('cancel_date')->nullable()->comment('キャンセル日時');
            $table->integer('number_of_people')->comment('予約人数');
            $table->string('first_name')->comment('予約者姓');
            $table->string('last_name')->comment('予約者名');
            $table->string('contact_address')->comment('連絡先メールアドレス');
            $table->string('contact_tel')->comment('連絡先電話番号');
            $table->text('remarks', 3000)->nullable()->comment('備考');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('restaurant_informations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('seat_id')->references('id')->on('seats')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('予約管理テーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve_datas');
    }
};
