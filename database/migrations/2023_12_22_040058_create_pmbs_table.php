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
        Schema::create('pmbs', function (Blueprint $table) {
            $table->id();
            $table->string('prodi');
            $table->string('year');
            $table->integer('number_of_registrants');
            $table->integer('quota_accepted');
            $table->integer('re_registration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmbs');
    }
};
