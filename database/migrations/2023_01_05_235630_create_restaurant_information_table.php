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
        Schema::create('restaurant_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id')->comment('管理アカウントID');
            $table->string('restaurant_name')->comment('店舗名');
            $table->string('restaurant_email')->nullable()->default(null)->comment('店舗メールアドレス');
            $table->string('restaurant_tel')->nullable()->default(null)->comment('店舗電話番号');
            $table->json('notification_email')->nullable()->default(null)->comment('通知用メールアドレス');
            $table->string('post_number')->nullable()->default(null)->comment('店舗郵便番号');
            $table->string('address')->nullable()->default(null)->comment('店舗住所');
            $table->string('address_after')->nullable()->default(null)->comment('以降の住所');
            $table->integer('display_order')->nullable()->default(1)->comment('表示順');
            $table->boolean('is_reserve')->nullable()->default(false)->comment('予約表示可能フラグ');
            $table->boolean('is_display')->nullable()->default(false)->comment('予約サイト表示フラグ');
            $table->boolean('is_take_out')->nullable()->default(false)->comment('テイクアウトフラグ');
            $table->string('representative_name')->nullable()->default(null)->comment('店舗代表者名');
            $table->string('representative_tel')->nullable()->default(null)->comment('店舗代表者電話番号');
            $table->text('feature', 3000)->nullable()->default(null)->comment('店舗の特徴・お客様へのアピールポイント');
            $table->unsignedBigInteger('lunch_budget_id')->nullable()->default(null)->comment('ランチタイム予算');
            $table->unsignedBigInteger('dinner_budget_id')->nullable()->default(null)->comment('ディナータイム予算');
            $table->unsignedBigInteger('main_category_id')->comment('メインカテゴリーID');
            $table->unsignedBigInteger('sub_category_id')->comment('サブカテゴリーID');
            $table->unsignedBigInteger('area_id')->nullable()->default(null)->comment('エリアID');
            $table->unsignedBigInteger('prefecture_id')->nullable()->default(null)->comment('都道府県ID');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_user_id')->references('id')->on('admins')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('lunch_budget_id')->references('id')->on('budgets')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('dinner_budget_id')->references('id')->on('budgets')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('prefecture_id')->references('id')->on('prefectures')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->comment('店舗情報テーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_informations');
    }
};
