<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penerbangan', function (Blueprint $table) {
            $table->id('id_penerbangan');
            $table->string('kota_pergi');
            $table->string('kota_tujuan');
            $table->time('waktu_tiba');
            $table->time('waktu_pergi');
            $table->date('tanggal');
            $table->enum('kelas', ['ekonomi', 'bisnis', 'vip']);
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penerbangan');
    }
};

