<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $histories = DB::table('histori')
            ->leftJoin('penerbangan', 'histori.id_penerbangan', '=', 'penerbangan.id_penerbangan')
            ->leftJoin('pelayaran', 'histori.id_pelayaran', '=', 'pelayaran.id_pelayaran')
            ->leftJoin('reservasi', 'histori.id_reservasi', '=', 'reservasi.id_reservasi')
            ->where('histori.user_id', $userId)
            ->select(
                'histori.*',
                'penerbangan.kota_pergi', 'penerbangan.kota_tujuan', 'penerbangan.tanggal as tanggal_penerbangan',
                'pelayaran.pelabuhan_awal', 'pelayaran.pelabuhan_akhir', 'pelayaran.tanggal as tanggal_pelayaran',
                'reservasi.lokasi as lokasi_reservasi', 'reservasi.jumlah_ruang'
            )
            ->orderBy('histori.created_at', 'desc')
            ->get();

        return view('history.index', ['histories' => $histories]);
    }
}
