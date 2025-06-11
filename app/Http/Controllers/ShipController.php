<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index()
    {
        // Nantinya kita bisa passing data pelabuhan dari database ke sini
        return view('ships.search');
    }

    public function search(Request $request)
    {
        // 1. Validasi input dari user
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'departure_date' => 'required|date',
            'ticket_type' => 'required',
            'passengers' => 'required|integer|min:1',
        ]);
        
        // 2. Ambil semua input dari form
        $searchData = $request->all();

        // 3. SIMULASI PENCARIAN DATA DARI DATABASE
        $voyages = $this->findDummyVoyages($request->origin, $request->destination, $request->departure_date, $request->departure_time);
        
        // 4. KALKULASI HARGA TOTAL untuk setiap jadwal yang ditemukan
        foreach ($voyages as &$voyage) { // Tanda '&' penting untuk modifikasi langsung
            $hargaKendaraan = $voyage['harga_kendaraan'][$request->ticket_type] ?? 0;
            $hargaPenumpang = $voyage['harga_per_orang'] * $request->passengers;
            $voyage['total_harga'] = $hargaPenumpang + $hargaKendaraan;
        }

        // 5. Kirim data yang sudah diolah ke view
        return view('ships.results', [
            'voyages' => $voyages,
            'searchData' => $searchData
        ]);
    }

    /**
     * Fungsi helper untuk membuat data dummy pelayaran.
     */
    private function findDummyVoyages($origin, $destination, $departureDate, $departureTime)
    {
        $allVoyages = [
            [
                'origin' => 'Tanjung Priok (Jakarta)',
                'destination' => 'Bakauheni (Lampung)',
                'berangkat' => Carbon::parse($departureDate . ' 22:00:00'),
                'durasi_jam' => 3,
                'harga_per_orang' => 75000,
                'harga_kendaraan' => [
                    'Pejalan Kaki' => 0,
                    'Sepeda Motor' => 150000,
                    'Mobil Pribadi' => 750000,
                ],
            ],
            [
                'origin' => 'Merak (Banten)',
                'destination' => 'Bakauheni (Lampung)',
                'berangkat' => Carbon::parse($departureDate . ' 10:00:00'),
                'durasi_jam' => 2,
                'harga_per_orang' => 50000,
                'harga_kendaraan' => [
                    'Pejalan Kaki' => 0,
                    'Sepeda Motor' => 120000,
                    'Mobil Pribadi' => 600000,
                ],
            ],
             [
                'origin' => 'Merak (Banten)',
                'destination' => 'Bakauheni (Lampung)',
                'berangkat' => Carbon::parse($departureDate . ' 14:30:00'),
                'durasi_jam' => 2,
                'harga_per_orang' => 50000,
                'harga_kendaraan' => [
                    'Pejalan Kaki' => 0,
                    'Sepeda Motor' => 120000,
                    'Mobil Pribadi' => 600000,
                ],
            ],
        ];

        // Filter berdasarkan rute
        $filtered = collect($allVoyages)->filter(function ($voyage) use ($origin, $destination) {
            return $voyage['origin'] == $origin && $voyage['destination'] == $destination;
        });

        // Tambahkan properti 'tiba' dan 'estimasi' ke setiap hasil filter
        return $filtered->map(function ($voyage) {
            $voyage['tiba'] = $voyage['berangkat']->copy()->addHours($voyage['durasi_jam']);
            $voyage['estimasi'] = $voyage['durasi_jam'] . ' Jam';
            return $voyage;
        })->all();
    }
}