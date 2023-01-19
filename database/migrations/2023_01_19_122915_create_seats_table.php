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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->comment('店舗ID');
            $table->integer('seat_number')->nullable()->comment('座席番号');
            $table->string('name', 64)->comment('座席表示名');
            $table->integer('max_number')->comment('最大人数');
            $table->integer('kind')->comment('1: カウンター, 2: テーブル, 3: 座敷, 4: 個室');
            $table->integer('priority')->comment('優先順');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('restaurant_informations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('座席管理テーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
};
