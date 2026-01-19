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
        // Fix gpa (IPK) in mahasiswas table: float → decimal(4,2)
        if (Schema::hasColumn('mahasiswas', 'gpa')) {
            // Clean and normalize data before type change
            // Convert any comma decimal separators to dots (if stored as string representation)
            // Clamp values to valid range (1.00 to 4.00)
            // Set invalid values (< 1.00 or > 4.00) to 1.00 as default
            DB::statement("
                UPDATE mahasiswas 
                SET gpa = GREATEST(1.00, LEAST(4.00, 
                    CASE 
                        WHEN gpa < 1.00 THEN 1.00
                        WHEN gpa > 4.00 THEN 4.00
                        ELSE ROUND(gpa, 2)
                    END
                ))
            ");
            
            // Change column type to decimal(4,2)
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->decimal('gpa', 4, 2)->change();
            });
        }

        // Fix nik in mahasiswas table: string → varchar(16)
        if (Schema::hasColumn('mahasiswas', 'nik')) {
            // Truncate NIK to 16 characters if longer
            DB::statement("UPDATE mahasiswas SET nik = LEFT(nik, 16)");
            
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->string('nik', 16)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert gpa in mahasiswas table
        if (Schema::hasColumn('mahasiswas', 'gpa')) {
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->float('gpa')->change();
            });
        }

        // Revert nik in mahasiswas table
        if (Schema::hasColumn('mahasiswas', 'nik')) {
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->string('nik')->change();
            });
        }
    }
};
