@extends('layouts.app')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-history"></i> Riwayat Pemesanan Saya</h2>
        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
            <i class="fas fa-user"></i> Kembali ke Profil
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($histories as $history)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center">
                        {{-- Tampilkan ikon berdasarkan jenis pesanan --}}
                        @if ($history->id_penerbangan)
                            <i class="fas fa-plane-departure fa-3x text-primary"></i>
                            <span class="d-block mt-2 fw-bold">Pesawat</span>
                        @elseif ($history->id_pelayaran)
                            <i class="fas fa-ship fa-3x text-info"></i>
                            <span class="d-block mt-2 fw-bold">Kapal</span>
                        @elseif ($history->id_reservasi)
                            <i class="fas fa-hotel fa-3x text-success"></i>
                            <span class="d-block mt-2 fw-bold">Hotel</span>
                        @endif
                    </div>
                    <div class="col-md-7">
                        {{-- Tampilkan detail berdasarkan jenis pesanan --}}
                        @if ($history->id_penerbangan)
                            <h5>{{ $history->kota_pergi }} <i class="fas fa-arrow-right"></i> {{ $history->kota_tujuan }}</h5>
                            <p class="mb-1 text-muted">
                                Tanggal: {{ \Carbon\Carbon::parse($history->tanggal_penerbangan)->format('d F Y') }}
                            </p>
                        @elseif ($history->id_pelayaran)
                             <h5>{{ $history->pelabuhan_awal }} <i class="fas fa-arrow-right"></i> {{ $history->pelabuhan_akhir }}</h5>
                             <p class="mb-1 text-muted">
                                Tanggal: {{ \Carbon\Carbon::parse($history->tanggal_pelayaran)->format('d F Y') }}
                            </p>
                        @elseif ($history->id_reservasi)
                            <h5>Reservasi Hotel di {{ $history->lokasi_reservasi }}</h5>
                            <p class="mb-1 text-muted">
                                Jumlah Ruang: {{ $history->jumlah_ruang }}
                            </p>
                        @endif
                        
                        <p class="mb-0 text-muted">
                            Tanggal Pesan: {{ \Carbon\Carbon::parse($history->created_at)->format('d F Y, H:i') }}
                        </p>
                    </div>
                    <div class="col-md-3 text-md-end">
                        <h5 class="text-success">Rp {{ number_format($history->harga_pembayaran, 0, ',', '.') }}</h5>
                        <span class="badge bg-secondary text-capitalize">
                            <i class="fas fa-credit-card"></i> {{ str_replace('_', ' ', $history->jenis_pembayaran) }}
                        </span>
                        <br>
                        @if ($history->status)
                            <span class="badge bg-success mt-2">
                                <i class="fas fa-check-circle"></i> Berhasil
                            </span>
                        @else
                             <span class="badge bg-danger mt-2">
                                <i class="fas fa-times-circle"></i> Gagal
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card text-center py-5">
            <div class="card-body">
                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Anda belum memiliki riwayat pemesanan.</h4>
                <p>Mulai perjalanan Anda sekarang!</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-2">Cari Tiket atau Hotel</a>
            </div>
        </div>
    @endforelse
</div>
@endsection