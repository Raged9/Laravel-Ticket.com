<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket Online</title>
    {{-- Memuat pustaka Tailwind CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    {{-- Container Utama --}}
    <div class="relative flex items-center justify-center min-h-screen">

        {{-- Tombol Profil di Pojok Kanan Atas --}}
        <div class="absolute top-0 right-0 p-6">
            <a href="{{ route('profile') }}" class="py-2 px-4 bg-white text-gray-700 rounded-lg shadow-md hover:bg-gray-200 transition duration-300">
                Profil
            </a>
        </div>

        {{-- Konten Utama di Tengah --}}
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Selamat Datang!
            </h1>
            <p class="text-lg text-gray-600 mb-12">
                Mau bepergian kemana hari ini?
            </p>

            {{-- Pilihan Transportasi --}}
            <div class="flex flex-col md:flex-row gap-6 justify-center">
                
                {{-- Tombol Pesawat --}}
                <a href="{{ route('flights.search') }}" class="group">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 w-64">
                        <i class='fas fa-plane-departure text-blue-500 text-6xl mb-4'></i>
                        <h2 class="text-2xl font-semibold text-gray-900">Pesawat</h2>
                    </div>
                </a>

                {{-- Tombol Kapal Laut --}}
                <a href="{{ route('ships.search') }}" class="group">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 w-64">
                        <i class="fas fa-anchor text-teal-500 text-6xl mb-4"></i>
                        <h2 class="text-2xl font-semibold text-gray-900">Kapal Laut</h2>
                    </div>
                </a>

            
                {{-- Tombol Hotel --}}
                <a href="{{ route('hotels.search') }}" class="group">
                     <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 w-64">
                        <i class="fas fa-bed text-orange-500 text-6xl mb-4"></i>
                        <h2 class="text-2xl font-semibold text-gray-900">Hotel</h2>
                    </div>
                </a>

            </div>
        </div>

    </div>
</body>
</html>