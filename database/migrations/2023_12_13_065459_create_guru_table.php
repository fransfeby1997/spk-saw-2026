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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30);
            $table->string('nama_guru', 60);
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin', 20)->default('Laki-laki');
            $table->string('jabatan', 50)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
