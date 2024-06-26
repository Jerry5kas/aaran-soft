<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\DbMigration::hasMagalir()) {

            Schema::create('mg_passbooks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('mg_club_id')->references('id')->on('mg_clubs');
                $table->foreignId('mg_member_id')->references('id')->on('mg_members');
                $table->foreignId('mg_loan_id')->references('id')->on('mg_loans');
                $table->date('due_date');
                $table->decimal('due_amount');
                $table->string('received_date')->nullable();
                $table->decimal('received');
                $table->string('remarks')->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('mg_passbooks');
    }
};
