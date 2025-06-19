@extends('layouts.app')

@section('title', 'Pembayaran Tiket Kapal')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="fas fa-money-bill-wave"></i> Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Detail Pelayaran</h5>
                    {{-- Asumsi variabel yang dikirim dari ShipController adalah $ship dan $totalPrice --}}
                    <table class="table table-sm table-borderless mb-4">
                        
                        <tr>
                            <td><strong>Rute</strong></td>
                            <td>: {{ $ship->pelabuhan_awal }} <i class="fas fa-arrow-right"></i> {{ $ship->pelabuhan_akhir }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>: {{ \Carbon\Carbon::parse($ship->tanggal)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Waktu</strong></td>
                            <td>: Berangkat {{ $ship->waktu_pergi }} - Tiba {{ $ship->waktu_tiba }}</td>
                        </tr>
                         <tr class="fs-5">
                            <td><strong>Total Harga</strong></td>
                            <td>: <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>

                    <hr>

                    <h5 class="card-title mt-4">Pilih Metode Pembayaran</h5>
                    <form action="{{ route('ships.payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pelayaran" value="{{ $ship->id_pelayaran }}">
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