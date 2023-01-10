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
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('都道府県名');
            $table->unsignedBigInteger('area_id')->comment('地方ID');
            $table->integer('prefecture_number')->comment('都道府県No');
            $table->string('alias')->comment('検索記号');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('都道府県テーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefectures');
    }
};
