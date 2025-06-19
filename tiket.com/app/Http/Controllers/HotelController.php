<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /**
     * Menampilkan form pencarian hotel dan mengisi dropdown lokasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $locations = DB::table('reservasi')->distinct()->pluck('lokasi');
        return view('hotels.search', ['locations' => $locations]);
    }

    /**
     * Menangani pencarian hotel dan menampilkan hasilnya dari database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|integer|min:1',
            'guests' => 'required|integer|min:1',
        ]);

        // 2. Query ke database tanpa filter tanggal
        $results = DB::table('reservasi')
            ->where('lokasi', $validated['location'])
            ->where('jumlah_ruang', '>=', $validated['rooms']) // Cek ketersediaan ruangan
            ->where('jumlah_orang', '>=', $validated['guests'])   // Cek kapasitas orang
            ->get();

        // 3. Proses hasil query dan hitung harga dinamis
        $hotels = $results->map(function ($item) use ($validated) {
            
            // Asumsi biaya tambahan per orang adalah 50,000
            $biayaPerOrang = 50000;

            // Hitung total harga berdasarkan jumlah ruangan dan orang
            $totalHarga = ($item->harga * $validated['rooms']) + ($biayaPerOrang * $validated['guests']);

            return [
                'id' => $item->id_reservasi,
                'name' => 'Akomodasi di ' . $item->lokasi,
                'location' => $item->lokasi,
                'price' => $totalHarga, // Gunakan harga yang sudah dihitung
            ];
        });

        return view('hotels.results', [
            'hotels' => $hotels,
            'search' => $validated,
        ]);
    }

    /**
     * Menampilkan halaman pembayaran untuk reservasi hotel yang dipilih.
     */
    public function showPaymentPage(Request $request, $id_reservasi)
    {
        $hotelData = DB::table('reservasi')->where('id_reservasi', $id_reservasi)->first();

        if (!$hotelData) {
            abort(404, 'Data reservasi tidak ditemukan.');
        }

        // Ambil data pencarian dari query string untuk menghitung harga lagi
        $searchParams = $request->query();
        $biayaPerOrang = 50000;
        $totalPrice = ($hotelData->harga * $searchParams['rooms']) + ($biayaPerOrang * $searchParams['guests']);
        
        return view('hotels.payment', [
            'hotelData' => $hotelData,
            'searchParams' => $searchParams,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Memproses pembayaran, membuat histori, dan update counter user.
     */
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'harga_pembayaran' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:bank,kartu_kredit,e-wallet',
        ]);

        DB::transaction(function () use ($validated) {
            $user = Auth::user();

            // Buat record baru di tabel histori
            DB::table('histori')->insert([
                'user_id' => $user->id,
                'id_reservasi' => $validated['id_reservasi'],
                'harga_pembayaran' => $validated['harga_pembayaran'],
                'jenis_pembayaran' => $validated['jenis_pembayaran'],
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tambah (increment) counter reservasi_hotel di tabel users
            $user->increment('reservasi_hotel');
        });

        return redirect()->route('history.index')->with('success', 'Reservasi hotel berhasil!');
    }
}