<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Tiket Pesawat</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:p-8">
        
        {{-- Judul Halaman Hasil --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Hasil Pencarian</h1>
            <p class="text-lg text-gray-600">
                {{ $searchData['origin'] }} → {{ $searchData['destination'] }} 
                <span class="font-semibold">({{ \Carbon\Carbon::parse($searchData['departure_date'])->format('D, d M Y') }})</span>
            </p>
        </div>

        {{-- Daftar Penerbangan --}}
        <div class="space-y-4">

            {{-- Loop untuk setiap penerbangan yang ditemukan --}}
            @forelse ($flights as $flight)
                <div class="bg-white rounded-lg shadow-md flex flex-col md:flex-row items-center p-4 transition hover:shadow-lg">
                    
                    {{-- Info Maskapai --}}
                    <div class="w-full md:w-1/4 flex items-center mb-4 md:mb-0">
                        {{-- <img src="{{ $flight['logo'] }}" alt="{{ $flight['maskapai'] }}" class="w-8 h-8 mr-3"> --}}
                        <span class="font-semibold text-gray-700">{{ $flight['maskapai'] }}</span>
                    </div>

                    {{-- Info Jadwal --}}
                    <div class="w-full md:w-2/4 flex items-center text-center">
                        <div class="w-1/3">
                            <div class="text-xl font-bold text-gray-900">{{ $flight['berangkat']->format('H:i') }}</div>
                            <div class="text-sm text-gray-500">{{ $flight['origin'] }}</div>
                        </div>
                        <div class="w-1/3 text-center">
                            <div class="text-sm text-gray-500">{{ $flight['durasi'] }}</div>
                            <div class="border-t-2 border-gray-300 mx-auto mt-1"></div>
                        </div>
                        <div class="w-1/3">
                            <div class="text-xl font-bold text-gray-900">{{ $flight['tiba']->format('H:i') }}</div>
                            <div class="text-sm text-gray-500">{{ $flight['destination'] }}</div>
                        </div>
                    </div>

                    {{-- Info Harga dan Tombol Pilih --}}
                    <div class="w-full md:w-1/4 flex flex-col items-end mt-4 md:mt-0">
                        <div class="text-xl font-bold text-orange-600">
                            Rp {{ number_format($flight['harga'], 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500 mb-2">/orang</div>
                        <a href="#" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                            Pilih
                        </a>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada penerbangan --}}
                <div class="bg-white rounded-lg shadow-md text-center p-8">
                    <h3 class="text-xl font-semibold text-gray-700">Oops! Tidak ada penerbangan.</h3>
                    <p class="text-gray-500 mt-2">Tidak ada jadwal penerbangan yang ditemukan untuk rute dan tanggal yang Anda pilih.</p>
                    <a href="{{ route('flights.search') }}" class="mt-4 inline-block bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300">
                        Coba Cari Lagi
                    </a>
                </div>
            @endforelse

        </div>

    </div>
</body>
</html>