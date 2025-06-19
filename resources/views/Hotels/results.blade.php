<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hasil Pencarian Hotel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex flex-col items-center p-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
            Hasil Pencarian Hotel
        </h1>

        <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-8">

            {{-- Tampilkan ringkasan pencarian --}}
            <div class="mb-8 p-4 bg-gray-50 rounded-lg border">
                <p><strong>Lokasi:</strong> {{ $search['location'] }}</p>
                <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($search['checkin'])->translatedFormat('d F Y') }}</p>
                <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($search['checkout'])->translatedFormat('d F Y') }}</p>
                <p><strong>Jumlah Ruangan:</strong> {{ $search['rooms'] }}</p>
                <p><strong>Jumlah Orang:</strong> {{ $search['guests'] }}</p>
            </div>

            @if(empty($hotels) || count($hotels) === 0)
                <div class="text-center text-gray-600 py-12">
                    <p class="mb-4 text-lg">Maaf, tidak ada hotel yang ditemukan sesuai kriteria pencarian Anda.</p>
                    <a href="{{ route('hotels.index') }}" class="inline-block bg-teal-500 hover:bg-teal-600 text-white px-6 py-3 rounded-lg transition-colors duration-300">
                        Kembali ke Pencarian
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($hotels as $hotel)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300 flex flex-col justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $hotel['name'] }}</h2>
                                <p class="text-gray-700 font-bold mb-4">Harga mulai dari: Rp {{ number_format($hotel['price'], 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('hotels.payment.show', [
                                'id_reservasi' => $hotel['id'], 
                                'checkin' => $search['checkin'],      
                                'checkout' => $search['checkout'],   
                                'rooms' => $search['rooms'], 
                                'guests' => $search['guests']
                                ]) }}" ...>
                                Pesan Sekarang
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</body>
</html>