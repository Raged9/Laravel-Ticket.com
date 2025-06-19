<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelayaranTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelayaran')->insert([
            [
                'pelabuhan_awal' => 'Tanjung Priok',
                'pelabuhan_akhir' => 'Batam',
                'jumlah_orang' => 2,
                'waktu_tiba' => '08:00:00',
                'waktu_pergi'=> '06:00:00',
                'tanggal' => '2025-07-05',
                'tipe' => 'mobil pribadi',
                'harga' => 750000,
            ]
        ]);
    }
}
