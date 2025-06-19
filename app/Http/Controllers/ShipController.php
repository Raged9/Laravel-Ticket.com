<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShipController extends Controller
{
    /**
     * Menampilkan halaman pencarian dan mengisi dropdown dari database.
     */
    public function index()
    {
        // Ambil data unik untuk dropdown dari tabel pelayaran
        $origins = DB::table('pelayaran')->distinct()->pluck('pelabuhan_awal');
        $destinations = DB::table('pelayaran')->distinct()->pluck('pelabuhan_akhir');

        // Kirim data ke view
        return view('ships.search', [
            'origins' => $origins,
            'destinations' => $destinations
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
            'ticket_type' => 'required|string',
            'passengers' => 'required|integer|min:1',
        ]);

        // 2. Ambil semua input dari form
        $searchData = $request->all();
        $departureDate = Carbon::parse($request->departure_date)->toDateString();

        // 3. Lakukan query ke database untuk mencari pelayaran yang cocok
        $results = DB::table('pelayaran')
            ->where('pelabuhan_awal', $request->origin)
            ->where('pelabuhan_akhir', $request->destination)
            ->whereDate('tanggal', $departureDate) // Cari berdasarkan tanggal saja
            ->where('tipe', $request->ticket_type) // Filter berdasarkan tipe tiket/kendaraan
            ->get();

        // 4. Proses hasil query untuk disesuaikan dengan format view
        $voyages = $results->map(function ($item) use ($request) {
            // Gabungkan tanggal dari DB dengan waktu pergi dan waktu tiba
            $berangkat = Carbon::parse($item->tanggal . ' ' . $item->waktu_pergi);
            $tiba = Carbon::parse($item->tanggal . ' ' . $item->waktu_tiba);

            // Penanganan jika waktu tiba keesokan harinya
            if ($tiba->lt($berangkat)) {
                $tiba->addDay();
            }

            // Hitung durasi perjalanan
            $durasi = $berangkat->diff($tiba);
            $estimasi = $durasi->format('%h j %i m');

            // Kalkulasi harga total
            $totalHarga = $item->harga * $request->passengers;

            return [
                'id_pelayaran' => $item->id_pelayaran, 
                'origin' => $item->pelabuhan_awal,
                'destination' => $item->pelabuhan_akhir,
                'berangkat' => $berangkat, // Objek Carbon
                'tiba' => $tiba,         // Objek Carbon
                'estimasi' => $estimasi,
                'total_harga' => $totalHarga,
            ];
        });

        // 5. Kirim data yang sudah diolah ke view
        return view('ships.results', [
            'voyages' => $voyages,
            'searchData' => $searchData,
        ]);
    }

    /**
     * Menampilkan halaman pembayaran untuk tiket kapal yang dipilih.
     */
    public function showPaymentPage(Request $request, $id_pelayaran)
    {
        $ship = DB::table('pelayaran')->where('id_pelayaran', $id_pelayaran)->first();

        if (!$ship) {
            abort(404, 'Data pelayaran tidak ditemukan.');
        }

        // Ambil jumlah penumpang dari query string dan hitung total harga
        $passengers = $request->query('passengers', 1);
        $totalPrice = $ship->harga * $passengers;

        return view('ships.payment', [
            'ship' => $ship,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Memproses pembayaran, membuat histori, dan update counter user.
     */
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'id_pelayaran' => 'required|exists:pelayaran,id_pelayaran',
            'harga_pembayaran' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:bank,kartu_kredit,e-wallet',
        ]);

        DB::transaction(function () use ($validated) {
            $user = Auth::user();

            // Buat record baru di tabel histori
            DB::table('histori')->insert([
                'user_id' => $user->id,
                'id_pelayaran' => $validated['id_pelayaran'],
                'harga_pembayaran' => $validated['harga_pembayaran'],
                'jenis_pembayaran' => $validated['jenis_pembayaran'],
                'status' => true, // Asumsi pembayaran selalu berhasil
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tambah (increment) counter tiket_kapal di tabel users (opsional)
            // Pastikan kolom 'tiket_kapal' ada di tabel 'users' melalui migration
            if (Schema::hasColumn('users', 'tiket_kapal')) {
                $user->increment('tiket_kapal');
            }
        });

        return redirect()->route('history.index')->with('success', 'Pemesanan tiket kapal berhasil!');
    }
}