<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Tiket Kapal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:p-8">
        
        {{-- Judul Halaman Hasil --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Hasil Pencarian Pelayaran</h1>
            <p class="text-lg text-gray-600">
                {{ $searchData['origin'] }} → {{ $searchData['destination'] }} 
                <span class="font-semibold">({{ \Carbon\Carbon::parse($searchData['departure_date'])->format('D, d M Y') }})</span>
            </p>
            <p class="text-md text-gray-500">
                Untuk {{ $searchData['passengers'] }} penumpang dengan {{ $searchData['ticket_type'] }}
            </p>
        </div>

        {{-- Daftar Pelayaran --}}
        <div class="space-y-4">

            {{-- Loop untuk setiap pelayaran yang ditemukan --}}
            @forelse ($voyages as $voyage)
                <div class="bg-white rounded-lg shadow-md flex flex-col md:flex-row items-center p-4 transition hover:shadow-lg">
                    
                    {{-- Info Jadwal --}}
                    <div class="w-full md:w-3/4 flex items-center text-center">
                        <div class="w-1/3">
                            <div class="text-xl font-bold text-gray-900">{{ $voyage['berangkat']->format('H:i') }}</div>
                            <div class="text-sm text-gray-500">{{ $voyage['origin'] }}</div>
                        </div>
                        <div class="w-1/3 text-center">
                            <div class="text-sm text-gray-500">{{ $voyage['estimasi'] }}</div>
                            <div class="border-t-2 border-teal-300 mx-auto mt-1"></div>
                        </div>
                        <div class="w-1/3">
                            <div class="text-xl font-bold text-gray-900">{{ $voyage['tiba']->format('H:i') }}</div>
                            <div class="text-sm text-gray-500">{{ $voyage['destination'] }}</div>
                        </div>
                    </div>

                    {{-- Info Harga dan Tombol Pilih --}}
                    <div class="w-full md:w-1/4 flex flex-col items-center md:items-end mt-4 md:mt-0">
                        <div class="text-xl font-bold text-orange-600">
                            Rp {{ number_format($voyage['total_harga'], 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500 mb-2">Total Harga</div>
                        <a href="#" class="bg-teal-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-teal-700 transition duration-300">
                            Pilih
                        </a>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada pelayaran --}}
                <div class="bg-white rounded-lg shadow-md text-center p-8">
                    <h3 class="text-xl font-semibold text-gray-700">Oops! Tidak ada jadwal pelayaran.</h3>
                    <p class="text-gray-500 mt-2">Tidak ada jadwal yang ditemukan untuk rute dan tanggal yang Anda pilih.</p>
                    <a href="{{ route('ships.search') }}" class="mt-4 inline-block bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300">
                        Coba Cari Lagi
                    </a>
                </div>
            @endforelse

        </div>

    </div>
</body>
</html>