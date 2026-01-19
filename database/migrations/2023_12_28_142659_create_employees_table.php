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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('name');
            $table->string('generation');
            $table->string('education');
            $table->string('work_bond');
            $table->string('active_status');
            $table->string('card_number_status');
            $table->string('prodi');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->string('religion');
            $table->text('address');
            $table->enum('gender', ['men', 'woman']);
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
