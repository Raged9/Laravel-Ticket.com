<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-12 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Simulasi Pembayaran Tiket</h2>

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="block mb-1 font-semibold text-gray-700">Nominal (Rp):</label>
            <input type="number" name="amount" required
                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-6">
            <label class="block mb-2 font-semibold text-gray-700">Pilih Metode Pembayaran:</label>

            <div class="space-y-3">
                <label class="flex items-center p-3 border rounded hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="bank" class="mr-2" required>
                    <span>Transfer Bank</span>
                </label>

                <label class="flex items-center p-3 border rounded hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="credit_card" class="mr-2">
                    <span>Kartu Kredit</span>
                </label>

                <label class="flex items-center p-3 border rounded hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="e_wallet" class="mr-2">
                    <span>E-Wallet</span>
                </label>
            </div>

            @error('payment_method')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Bayar Sekarang
        </button>
    </form>
</div>

</body>
</html>
