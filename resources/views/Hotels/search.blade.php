<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pesan Hotel - Pilih Detail Menginap</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    {{-- Container Utama --}}
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="bg-white rounded-xl shadow-lg p-10 max-w-md w-full">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                Pilih Detail Menginap
            </h1>

            <form action="{{ route('hotels.results') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Lokasi Menginap (Dropdown) --}}
                <div>
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Lokasi Menginap</label>
                    <select
                        name="location"
                        id="location"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    >
                        <option value="" disabled selected>Pilih Lokasi</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}">{{ $location }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Check-in --}}
                <div>
                    <label for="checkin" class="block text-gray-700 font-semibold mb-2">Tanggal Check-in</label>
                    <input
                        type="date"
                        name="checkin"
                        id="checkin"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    />
                </div>

                {{-- Tanggal Check-out --}}
                <div>
                    <label for="checkout" class="block text-gray-700 font-semibold mb-2">Tanggal Check-out</label>
                    <input
                        type="date"
                        name="checkout"
                        id="checkout"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    />
                </div>

                {{-- Jumlah Ruangan --}}
                <div>
                    <label for="rooms" class="block text-gray-700 font-semibold mb-2">Jumlah Ruangan</label>
                    <input
                        type="number"
                        name="rooms"
                        id="rooms"
                        min="1"
                        value="1"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    />
                </div>

                {{-- Jumlah Orang --}}
                <div>
                    <label for="guests" class="block text-gray-700 font-semibold mb-2">Jumlah Orang</label>
                    <input
                        type="number"
                        name="guests"
                        id="guests"
                        min="1"
                        value="1"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-3 rounded-lg transition-colors duration-300"
                >
                    Cari Hotel
                </button>
            </form>
        </div>
    </div>
</body>
</html>