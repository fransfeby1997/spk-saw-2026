<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change periode column in nilai_terbobot from unsignedBigInteger to string
        Schema::table('nilai_terbobot', function (Blueprint $table) {
            $table->string('periode', 50)->change();
        });

        // Change periode column in penilaian from year to string
        Schema::table('penilaian', function (Blueprint $table) {
            $table->string('periode', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_terbobot', function (Blueprint $table) {
            $table->unsignedBigInteger('periode')->change();
        });

        Schema::table('penilaian', function (Blueprint $table) {
            $table->year('periode')->change();
        });
    }
};
