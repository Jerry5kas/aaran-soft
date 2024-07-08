<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\DbMigration::hasSportsClub()) {

            Schema::create('sport_masters', function (Blueprint $table) {
                $table->id();
                $table->string('vname');
                $table->string('mobile');
                $table->string('whatsapp')->nullable();
                $table->string('email')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->foreignId('city_id')->references('id')->on('cities');
                $table->foreignId('state_id')->references('id')->on('states');
                $table->foreignId('pincode_id')->references('id')->on('pincodes');
                $table->foreignId('sport_club')->nullable();
                $table->string('grade')->nullable();
                $table->string('experience')->nullable();
                $table->string('dob')->nullable();
                $table->string('age')->nullable();
                $table->string('gender')->nullable();
                $table->string('aadhaar')->nullable();
                $table->string('master_photo')->nullable();
                $table->string('active_id', 3)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sport_masters');
    }
};