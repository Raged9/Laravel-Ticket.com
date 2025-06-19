<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    /**
     * Menampilkan halaman pencarian dan mengisi dropdown dari database.
     */
    public function index()
    {
        // Ambil data unik untuk dropdown dari tabel penerbangan
        $origins = DB::table('penerbangan')->distinct()->pluck('kota_pergi');
        $destinations = DB::table('penerbangan')->distinct()->pluck('kota_tujuan');
        $classes = DB::table('penerbangan')->distinct()->pluck('kelas');

        // Kirim data ke view
        return view('flights.search', [
            'origins' => $origins,
            'destinations' => $destinations,
            'classes' => $classes,
        ]);
    }

    /**
     * Memproses pencarian dan menampilkan hasilnya dari database.
     */
    public function search(Request $request)
    {
        // 1. Validasi input dari user
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'flight_class' => 'required|string', // Validasi untuk kelas
        ]);

        // 2. Ambil input dari form untuk ditampilkan kembali
        $searchData = $request->all();
        $departureDate = Carbon::parse($request->departure_date)->toDateString();

        // 3. Lakukan query ke database untuk mencari penerbangan yang cocok
        $results = DB::table('penerbangan')
            ->where('kota_pergi', $request->origin)
            ->where('kota_tujuan', $request->destination)
            ->where('tanggal', $departureDate)
            ->where('kelas', $request->flight_class) // Filter berdasarkan kelas
            ->get();

        // 4. Proses hasil query untuk disesuaikan dengan format view
        $flights = $results->map(function ($flight) {
            // Gabungkan tanggal dan waktu untuk membuat objek Carbon yang lengkap
            $berangkat = Carbon::parse($flight->tanggal . ' ' . $flight->waktu_pergi);
            $tiba = Carbon::parse($flight->tanggal . ' ' . $flight->waktu_tiba);
            
            // Handle jika penerbangan melewati tengah malam
            if ($tiba->lessThan($berangkat)) {
                $tiba->addDay();
            }

            // Hitung durasi penerbangan
            $durasi = $berangkat->diff($tiba)->format('%hj %im');

            return [
                'id_penerbangan' => $flight->id_penerbangan,
                'origin' => $flight->kota_pergi,
                'destination' => $flight->kota_tujuan,
                'berangkat' => $berangkat,
                'tiba' => $tiba,
                'durasi' => $durasi,
                'harga' => $flight->harga,
                'kelas' => $flight->kelas,
            ];
        });

        // 5. Kirim data penerbangan yang ditemukan ke view 'results'
        return view('flights.results', [
            'flights' => $flights,
            'searchData' => $searchData
        ]);

        
    }
    /**
     * Menampilkan halaman pembayaran untuk tiket pesawat yang dipilih.
     */
    public function showPaymentPage($id_penerbangan)
    {
        $flight = DB::table('penerbangan')->where('id_penerbangan', $id_penerbangan)->first();

        if (!$flight) {
            abort(404, 'Data penerbangan tidak ditemukan.');
        }

        return view('flights.payment', [
            'flight' => $flight,
            'totalPrice' => $flight->harga // Harga diasumsikan per tiket
        ]);
    }

    /**
     * Memproses pembayaran, membuat histori, dan update counter user.
     */
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'id_penerbangan' => 'required|exists:penerbangan,id_penerbangan',
            'harga_pembayaran' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:bank,kartu_kredit,e-wallet',
        ]);

        DB::transaction(function () use ($validated) {
            $user = Auth::user();

            // Buat record baru di tabel histori
            DB::table('histori')->insert([
                'user_id' => $user->id,
                'id_penerbangan' => $validated['id_penerbangan'],
                'harga_pembayaran' => $validated['harga_pembayaran'],
                'jenis_pembayaran' => $validated['jenis_pembayaran'],
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tambah (increment) counter tiket_pesawat di tabel users
            $user->increment('tiket_pesawat');
        });

        return redirect()->route('history.index')->with('success', 'Pemesanan tiket pesawat berhasil!');
    }
}