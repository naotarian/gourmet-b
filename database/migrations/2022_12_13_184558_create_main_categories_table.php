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
        Schema::create('main_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('カテゴリー名');
            $table->integer('display_order')->nullable()->comment('表示順');
            $table->string('alias')->comment('検索記号');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('メインカテゴリーテーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_categories');
    }
};
