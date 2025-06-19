<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbanganTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penerbangan')->insert([
            [
                'kota_pergi' => 'Jakarta',
                'kota_tujuan' => 'Bali',
                'tanggal' => '2025-07-01',
                'waktu_tiba' => '08:00:00',
                'waktu_pergi'=> '06:00:00',
                'kelas' => 'ekonomi',
                'harga' => 1500000,
            ],
            [
                'kota_pergi' => 'Surabaya',
                'kota_tujuan' => 'Medan',
                'tanggal' => '2025-07-02',
                'waktu_tiba' => '08:00:00',
                'waktu_pergi'=> '06:00:00',
                'kelas' => 'vip',
                'harga' => 2500000,
            ]
        ]);
    }
}
