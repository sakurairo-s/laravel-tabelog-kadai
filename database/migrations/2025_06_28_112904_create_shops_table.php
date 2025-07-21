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
        Schema::create('shops', function (Blueprint $table) {
            $table->id(); // PK: ID
            $table->foreignId('category_id')->constrained(); // FK: カテゴリID（categories テーブルを参照）
            $table->string('name'); // 店名
            $table->text('description')->nullable(); // 説明
            $table->integer('price_min')->nullable(); // 価格帯（下限）
            $table->integer('price_max')->nullable(); // 価格帯（上限）
            $table->time('business_hour_start')->nullable(); // 営業時間（開店）
            $table->time('business_hour_end')->nullable(); // 営業時間（閉店）
            $table->string('postal_code', 10)->nullable(); // 郵便番号
            $table->string('address')->nullable(); // 住所
            $table->string('phone_number', 20)->nullable(); // 電話番号
            $table->string('holiday')->nullable(); // 定休日（例: 月曜・火曜など）
            $table->date('registered_at')->nullable(); // 登録日
            $table->timestamps(); // Laravel 標準の created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
};
