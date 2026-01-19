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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('prodi');
            $table->string('nim');
            $table->string('nik');
            $table->string('name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('religion');
            $table->string('phone_number');
            $table->enum('gender', ['men', 'woman']);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->string('mothers_name');
            $table->string('fathers_name');
            $table->string('generation');
            $table->string('lecturer');
            $table->float('gpa');
            $table->string('status');
            $table->string('prakerin_status');
            $table->string('seminar_status');
            $table->string('meeting_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
