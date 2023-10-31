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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->float('latitude');
            $table->float('longitude');
            $table->timestamps();

            // 👈　ここに　users に対する外部キー制約を追記
        });

        // 👈　ここに　users　側に cities への制約を追記

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 👈　ここに　users からの外部キー制約の drop を追記

        Schema::dropIfExists('cities');

    }
};
