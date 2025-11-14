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
        Schema::create('persil', function (Blueprint $table) {
            $table->id('persil_id'); // Primary Key
            $table->string('kode_persil', 50)->unique(); // Kode Unik Persil
            $table->unsignedBigInteger('pemilik_warga_id'); // Foreign Key ke tabel warga
            $table->decimal('luas_m2', 10, 2)->nullable(); // Luas dalam m2
            $table->string('penggunaan', 100)->nullable(); // Jenis penggunaan lahan
            $table->string('alamat_lahan', 150)->nullable(); // Alamat lahan
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();

            $table->timestamps();

            // Relasi ke tabel warga
            $table->foreign('pemilik_warga_id')
                  ->references('warga_id') // sesuaikan dengan kolom PK di tabel warga
                  ->on('warga')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persil');
    }
};
