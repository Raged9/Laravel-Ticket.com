@extends('layouts.app')

@section('title', 'Pembayaran Tiket Pesawat')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-money-bill-wave"></i> Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Detail Penerbangan</h5>
                    <table class="table table-sm table-borderless mb-4">
                        <tr>
                            <td style="width: 150px;"><strong>Maskapai</strong></td>
                            <td>: {{ $flight->maskapai ?? 'Nama Maskapai' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Rute</strong></td>
                            <td>: {{ $flight->kota_pergi }} <i class="fas fa-arrow-right"></i> {{ $flight->kota_tujuan }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>: {{ \Carbon\Carbon::parse($flight->tanggal)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Waktu</strong></td>
                            <td>: Berangkat {{ $flight->waktu_pergi }} - Tiba {{ $flight->waktu_tiba }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kelas</strong></td>
                            <td>: {{ $flight->kelas }}</td>
                        </tr>
                        <tr class="fs-5">
                            <td><strong>Total Harga</strong></td>
                            <td>: <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>

                    <hr>

                    <h5 class="card-title mt-4">Pilih Metode Pembayaran</h5>
                    <form action="{{ route('flights.payment.process') }}" method="POST">
                        @csrf
                        {{-- Data tersembunyi untuk dikirim ke controller --}}
                        <input type="hidden" name="id_penerbangan" value="{{ $flight->id_penerbangan }}">
                        <input type="hidden" name="harga_pembayaran" value="{{ $totalPrice }}">

                        <div class="list-group">
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="jenis_pembayaran" value="bank" required>
                                <i class="fas fa-university"></i> Transfer Bank
                            </label>
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="jenis_pembayaran" value="kartu_kredit">
                                <i class="fas fa-credit-card"></i> Kartu Kredit
                            </label>
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-2" type="radio" name="jenis_pembayaran" value="e-wallet">
                                <i class="fas fa-wallet"></i> E-Wallet
                            </label>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-lock"></i> Bayar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection