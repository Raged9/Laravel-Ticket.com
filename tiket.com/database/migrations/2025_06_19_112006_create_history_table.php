<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('histori', function (Blueprint $table) {
            $table->id('id_histori');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign keys
            $table->unsignedBigInteger('id_penerbangan')->nullable();
            $table->unsignedBigInteger('id_pelayaran')->nullable();
            $table->unsignedBigInteger('id_reservasi')->nullable();

            $table->enum('jenis_pembayaran', ['bank', 'kartu_kredit', 'e-wallet']);
            $table->decimal('harga_pembayaran', 15, 2);
            $table->boolean('status')->default(false); // false = belum lunas, true = lunas

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_penerbangan')->references('id_penerbangan')->on('penerbangan')->onDelete('set null');
            $table->foreign('id_pelayaran')->references('id_pelayaran')->on('pelayaran')->onDelete('set null');
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('histori');
    }
};
