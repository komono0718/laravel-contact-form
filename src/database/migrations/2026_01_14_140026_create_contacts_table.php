<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // お名前
            $table->string('last_name');
            $table->string('first_name');

            // 性別（1:男性 2:女性 3:その他）
            $table->tinyInteger('gender');

            // メールアドレス
            $table->string('email');

            // 電話番号（3分割）
            $table->string('tel1', 5);
            $table->string('tel2', 5);
            $table->string('tel3', 5);

            // 住所
            $table->string('address');

            // 建物名（任意）
            $table->string('building')->nullable();

            // お問い合わせ種別
            $table->unsignedTinyInteger('category_id');

            // お問い合わせ内容
            $table->text('content');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}