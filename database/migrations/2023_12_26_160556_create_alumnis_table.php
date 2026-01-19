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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->enum('gender', ['men', 'woman']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->text('address');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->string('prodi');
            $table->string('entry_year');
            $table->string('graduation_year');
            $table->string('work_status');
            $table->string('work_waiting_time');
            $table->string('institution_name');
            $table->string('job_according_major');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
