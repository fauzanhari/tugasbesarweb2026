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
        Schema::create('dosen_keahlian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bidang_keahlian');
            $table->timestamps();
        });

        Schema::create('pengajuan_lomba', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dosen_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_lomba');
            $table->string('file_proposal');
            $table->enum('status', ['Menunggu', 'Revisi', 'ACC'])->default('Menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('konten');
            $table->date('tanggal');
            $table->timestamps();
        });

        // Menambahkan kolom role ke tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'dosen', 'mahasiswa', 'publik'])->default('publik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::dropIfExists('berita');
        Schema::dropIfExists('pengajuan_lomba');
        Schema::dropIfExists('dosen_keahlian');
    }
};
