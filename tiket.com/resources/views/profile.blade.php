@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user"></i> Profil Saya
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Profil -->
                        <div class="col-md-6">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle"></i> Informasi Akun
                                    </h6>
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>{{ Auth::user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ Auth::user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bergabung:</strong></td>
                                            <td>{{ Auth::user()->created_at->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td><span class="badge bg-success">Aktif</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Aksi -->
                        <div class="col-md-6">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-cogs"></i> Menu Aksi
                                    </h6>
                                    <div class="d-grid gap-2">
                                        <a href="/profile/edit" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit Profil
                                        </a>
                                        <a href="/profile/password" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-key"></i> Ubah Password
                                        </a>
                                        <a href="/history" class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-history"></i> Riwayat Pemesanan
                                        </a>
                                        <a href="/" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-home"></i> Kembali ke Home
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <!-- Statistik atau Info Tambahan -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <i class="fas fa-chart-bar"></i> Aktivitas Saya
                                            </h6>
                                            <div class="row text-center">
                                                {{-- UBAH BAGIAN INI --}}
                                                <div class="col-md-4">
                                                    <div class="p-3">
                                                        <h4 class="text-primary">{{ Auth::user()->tiket_pesawat }}</h4>
                                                        <small class="text-muted">Tiket Pesawat</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="p-3">
                                                        <h4 class="text-success">{{ Auth::user()->reservasi_hotel }}</h4>
                                                        <small class="text-muted">Hotel Booking</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="p-3">
                                                        <h4 class="text-info">{{ Auth::user()->tiket_kapal }}</h4>
                                                        <small class="text-muted">Tiket Kapal</small>
                                                    </div>
                                                </div>
                                                {{-- AKHIR PERUBAHAN --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection