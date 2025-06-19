@extends('layouts.app')

@section('title', 'Pembayaran Booking Hotel')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-money-bill-wave"></i> Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Detail Reservasi Hotel</h5>
                    {{-- Menggunakan variabel $hotelData dan $searchParams yang dikirim dari controller --}}
                    <table class="table table-sm table-borderless mb-4">
                        <tr>
                            <td style="width: 150px;"><strong>Lokasi</strong></td>
                            <td>: {{ $hotelData->lokasi }}</td>
                        </tr>
                        <tr>
                            <td><strong>Check-in</strong></td>
                            <td>: {{ \Carbon\Carbon::parse($searchParams['checkin'])->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Check-out</strong></td>
                            <td>: {{ \Carbon\Carbon::parse($searchParams['checkout'])->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Ruang</strong></td>
                            <td>: {{ $searchParams['rooms'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Orang</strong></td>
                            <td>: {{ $searchParams['guests'] }}</td>
                        </tr>
                         <tr class="fs-5">
                            <td><strong>Total Harga</strong></td>
                            <td>: <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>

                    <hr>

                    <h5 class="card-title mt-4">Pilih Metode Pembayaran</h5>
                    <form action="{{ route('hotels.payment.process') }}" method="POST">
                        @csrf
                        {{-- Menggunakan id dari $hotelData --}}
                        <input type="hidden" name="id_reservasi" value="{{ $hotelData->id_reservasi }}">
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