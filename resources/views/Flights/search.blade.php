<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Tiket Pesawat</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Cari Tiket Pesawat</h1>

            <form action="{{ route('flights.results') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    {{-- Kota Asal --}}
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700">Dari Kota Mana?</label>
                        <select id="origin" name="origin" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option disabled selected value="">Pilih Kota Asal</option>
                            @foreach ($origins as $origin)
                                <option value="{{ $origin }}">{{ $origin }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kota Tujuan --}}
                    <div>
                        <label for="destination" class="block text-sm font-medium text-gray-700">Ke Kota Mana?</label>
                        <select id="destination" name="destination" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option disabled selected value="">Pilih Kota Tujuan</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination }}">{{ $destination }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    {{-- Tanggal Berangkat --}}
                    <div>
                        <label for="departure_date" class="block text-sm font-medium text-gray-700">Tanggal Berangkat</label>
                        <input type="date" id="departure_date" name="departure_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                    </div>

                    {{-- Kelas Penerbangan --}}
                    <div>
                        <label for="flight_class" class="block text-sm font-medium text-gray-700">Kelas Penerbangan</label>
                        <select id="flight_class" name="flight_class" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                             <option disabled selected value="">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class }}">{{ $class }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-teal-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-teal-700 transition duration-300">
                        Cari Penerbangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>