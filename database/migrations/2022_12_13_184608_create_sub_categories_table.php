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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_category_id')->comment('メインカテゴリーID');
            $table->string('name')->comment('カテゴリー名');
            $table->integer('display_order')->nullable()->comment('表示順');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('サブカテゴリーテーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
