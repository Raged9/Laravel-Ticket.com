<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Tiket Pesawat</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Cari Tiket Pesawat</h1>

            <form action="{{ route('flights.results') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Kota Asal --}}
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700">Dari Kota Mana?</label>
                        <select id="origin" name="origin" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Jakarta (CGK)</option>
                            <option>Surabaya (SUB)</option>
                            <option>Bali (DPS)</option>
                        </select>
                    </div>

                    {{-- Kota Tujuan --}}
                    <div>
                        <label for="destination" class="block text-sm font-medium text-gray-700">Ingin Kemana?</label>
                        <select id="destination" name="destination" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Surabaya (SUB)</option>
                            <option>Jakarta (CGK)</option>
                            <option>Bali (DPS)</option>
                        </select>
                    </div>

                    {{-- Tanggal Berangkat --}}
                    <div>
                        <label for="departure_date" class="block text-sm font-medium text-gray-700">Tanggal Berangkat</label>
                        <input type="date" id="departure_date" name="departure_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    {{-- Kelas Penerbangan --}}
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                        <select id="class" name="class" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Ekonomi</option>
                            <option>Bisnis</option>
                            <option>First Class</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        Cari Penerbangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>