<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix generation in mahasiswas table (string to integer)
        // Note: This requires doctrine/dbal package for column type changes
        if (Schema::hasColumn('mahasiswas', 'generation')) {
            // Clean data first - convert numeric strings to integers, set non-numeric to 0
            DB::table('mahasiswas')->whereRaw('generation NOT REGEXP "^[0-9]+$"')->update(['generation' => '0']);
            DB::statement('UPDATE mahasiswas SET generation = CAST(generation AS UNSIGNED)');
            
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->integer('generation')->change();
            });
        }

        // Fix entry_year in alumnis table (string to integer)
        if (Schema::hasColumn('alumnis', 'entry_year')) {
            DB::table('alumnis')->whereRaw('entry_year NOT REGEXP "^[0-9]+$"')->update(['entry_year' => '0']);
            DB::statement('UPDATE alumnis SET entry_year = CAST(entry_year AS UNSIGNED)');
            
            Schema::table('alumnis', function (Blueprint $table) {
                $table->integer('entry_year')->change();
            });
        }

        // Fix graduation_year in alumnis table (string to integer)
        if (Schema::hasColumn('alumnis', 'graduation_year')) {
            DB::table('alumnis')->whereRaw('graduation_year NOT REGEXP "^[0-9]+$"')->update(['graduation_year' => '0']);
            DB::statement('UPDATE alumnis SET graduation_year = CAST(graduation_year AS UNSIGNED)');
            
            Schema::table('alumnis', function (Blueprint $table) {
                $table->integer('graduation_year')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert generation in mahasiswas table
        if (Schema::hasColumn('mahasiswas', 'generation')) {
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->string('generation')->change();
            });
        }

        // Revert entry_year in alumnis table
        if (Schema::hasColumn('alumnis', 'entry_year')) {
            Schema::table('alumnis', function (Blueprint $table) {
                $table->string('entry_year')->change();
            });
        }

        // Revert graduation_year in alumnis table
        if (Schema::hasColumn('alumnis', 'graduation_year')) {
            Schema::table('alumnis', function (Blueprint $table) {
                $table->string('graduation_year')->change();
            });
        }
    }
};
