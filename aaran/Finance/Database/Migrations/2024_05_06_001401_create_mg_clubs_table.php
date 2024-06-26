<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\DbMigration::hasMagalir()) {

            Schema::create('mg_clubs', function (Blueprint $table) {
                $table->id();
                $table->string('vno')->unique();;
                $table->string('vname')->nullable();
                $table->string('desc')->nullable();
                $table->string('active_id', 3)->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('mg_clubs');
    }
};
