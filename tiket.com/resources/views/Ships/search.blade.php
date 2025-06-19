<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Tiket Kapal Laut</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Cari Tiket Kapal Laut</h1>

            <form action="{{ route('ships.results') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Pelabuhan Asal --}}
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700">Dari Pelabuhan Mana?</label>
                        <select id="origin" name="origin" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option disabled selected>Pilih Pelabuhan Asal</option>
                            @foreach ($origins as $origin)
                                <option value="{{ $origin }}">{{ $origin }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pelabuhan Tujuan --}}
                    <div>
                        <label for="destination" class="block text-sm font-medium text-gray-700">Ke Pelabuhan Mana?</label>
                        <select id="destination" name="destination" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option disabled selected>Pilih Pelabuhan Tujuan</option>
                             @foreach ($destinations as $destination)
                                <option value="{{ $destination }}">{{ $destination }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Berangkat --}}
                    <div class="md:col-span-2">
                        <label for="departure_date" class="block text-sm font-medium text-gray-700">Tanggal Berangkat</label>
                        <input type="date" id="departure_date" name="departure_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                    </div>

                    {{-- Tipe Tiket/Kendaraan --}}
                    <div>
                        <label for="ticket_type" class="block text-sm font-medium text-gray-700">Tipe Tiket (Kendaraan)</label>
                        <select id="ticket_type" name="ticket_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option>Pejalan Kaki</option>
                            <option>Sepeda Motor</option>
                            <option>Mobil Pribadi</option>
                            <option>Truk Sedang</option>
                        </select>
                    </div>
                    
                    {{-- Jumlah Penumpang --}}
                    <div>
                        <label for="passengers" class="block text-sm font-medium text-gray-700">Jumlah Penumpang</label>
                        <input type="number" id="passengers" name="passengers" value="1" min="1" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-teal-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-teal-700 transition duration-300">
                        Cari Pelayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>