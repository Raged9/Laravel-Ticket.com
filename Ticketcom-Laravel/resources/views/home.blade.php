<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket Online</title>
    {{-- Memuat pustaka Tailwind CSS --}}
    @vite('resources/css/app.css')
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
                        <svg class="w-16 h-16 mx-auto mb-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <h2 class="text-2xl font-semibold text-gray-900">Pesawat</h2>
                    </div>
                </a>

                {{-- Tombol Kapal Laut --}}
                <a href="{{ route('ships.search') }}" class="group">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 w-64">
                        <svg class="w-16 h-16 mx-auto mb-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15h18l-3 4H6l-3-4z M12 15V7m0 0l4 2-4 0z"></path>
                        </svg>
                        <h2 class="text-2xl font-semibold text-gray-900">Kapal Laut</h2>
                    </div>
                </a>
            
                {{-- Tombol Hotel --}}
                <a href="{{ route('hotels.search') }}" class="group">
                     <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 w-64">
                        <svg class="w-16 h-16 mx-auto mb-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0H1m18 0h-2v4m0-4h-2m-4 0h2m-4-4v4M3 9l6 6M9 15h6m-6-6l6-6M15 3v6"></path>
                        </svg>
                        <h2 class="text-2xl font-semibold text-gray-900">Hotel</h2>
                    </div>
                </a>

            </div>
        </div>

    </div>
</body>
</html>