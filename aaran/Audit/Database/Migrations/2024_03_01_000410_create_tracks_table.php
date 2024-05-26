<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales-track', function (Blueprint $table) {
            $table->id();
            $table->string('vname')->unique();
            $table->smallInteger('active_id')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_tracks');
    }
};
