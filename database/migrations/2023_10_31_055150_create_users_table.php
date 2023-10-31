<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('city');  // cityカラムを追加
            $table->foreign('city')->references('city')->on('cities')->onDelete('cascade');  // 外部キー制約の設定
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 外部キー制約のドロップ
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city']);
        });

        Schema::dropIfExists('users');
    }
};
