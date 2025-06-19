<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FlightController extends Controller
{
    public function index()
    {
        // Nantinya kita bisa passing data kota dari database ke sini
        return view('flights.search');
    }

    public function search(Request $request)
    {
        // 1. Validasi input dari user
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'departure_date' => 'required|date',
        ]);

        // 2. Ambil input dari form untuk ditampilkan kembali
        $searchData = $request->all();

        // 3. SIMULASI PENCARIAN DATA DARI DATABASE
        // Kita buat data dummy di sini. Nantinya, ini akan diganti dengan query ke database.
        $flights = $this->findDummyFlights($request->origin, $request->destination, $request->departure_date);

        // 4. Kirim data penerbangan yang ditemukan ke view 'results'
        return view('flights.results', [
            'flights' => $flights,
            'searchData' => $searchData
        ]);
    }

    /**
     * Fungsi helper untuk membuat dan memfilter data dummy.
     * Nantinya ini akan diganti dengan query database asli.
     */
    private function findDummyFlights($origin, $destination, $departureDate)
    {
        $allFlights = [
            // Jadwal 1
            [
                'maskapai' => 'Garuda Indonesia',
                'logo' => '/images/garuda-logo.png',
                'berangkat' => Carbon::parse($departureDate)->setTime(7, 30), // Jam 07:30
                'tiba' => Carbon::parse($departureDate)->setTime(9, 0),    // Jam 09:00
                'durasi' => '1j 30m',
                'harga' => 1500000,
                'origin' => 'Jakarta (CGK)',
                'destination' => 'Surabaya (SUB)',
            ],
            // Jadwal 2
            [
                'maskapai' => 'Citilink',
                'logo' => '/images/citilink-logo.png',
                'berangkat' => Carbon::parse($departureDate)->setTime(10, 0), // Jam 10:00
                'tiba' => Carbon::parse($departureDate)->setTime(11, 30), // Jam 11:30
                'durasi' => '1j 30m',
                'harga' => 950000,
                'origin' => 'Jakarta (CGK)',
                'destination' => 'Surabaya (SUB)',
            ],
            // Jadwal 3
            [
                'maskapai' => 'Lion Air',
                'logo' => '/images/lion-air-logo.png',
                'berangkat' => Carbon::parse($departureDate)->setTime(14, 15), // Jam 14:15
                'tiba' => Carbon::parse($departureDate)->setTime(16, 45), // Jam 16:45
                'durasi' => '2j 30m',
                'harga' => 1800000,
                'origin' => 'Jakarta (CGK)',
                'destination' => 'Bali (DPS)',
            ],
        ];

        // Filter data dummy berdasarkan input user
        return collect($allFlights)->filter(function ($flight) use ($origin, $destination) {
            return $flight['origin'] == $origin && $flight['destination'] == $destination;
        })->all();
    }
}