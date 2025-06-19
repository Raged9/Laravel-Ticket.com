<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasiTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservasi')->insert([
            [
                'lokasi' => 'Hotel Merdeka, Yogyakarta',
                'jumlah_ruang' => 1,
                'jumlah_orang' => 2,
                'harga' => 900000,
            ]
        ]);
    }
}
