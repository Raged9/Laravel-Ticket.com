<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pelayaran', function (Blueprint $table) {
            $table->id('id_pelayaran');
            $table->string('pelabuhan_awal');
            $table->string('pelabuhan_akhir');
            $table->integer('jumlah_orang');
            $table->date('tanggal');
            $table->time('waktu_tiba');
            $table->time('waktu_pergi');
            $table->enum('tipe', ['pejalan kaki', 'sepeda motor', 'mobil pribadi', 'truk sedang']);
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pelayaran');
    }
};
?>
