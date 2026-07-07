<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 md:p-10">

    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                Halo, Vincentius! 👋
            </h1>
            <p class="text-gray-500 mt-1">Berikut ringkasan aktivitasmu hari ini.</p>
        </div>

        {{-- Grid kartu statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 text-blue-600 rounded-full w-10 h-10 flex items-center justify-center text-lg">📅</div>
                    <p class="text-sm text-gray-500 font-medium">Jadwal Hari Ini</p>
                </div>
                <p class="text-3xl font-bold text-gray-800 mt-4">{{ $stats['jadwal_hari_ini'] }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 text-green-600 rounded-full w-10 h-10 flex items-center justify-center text-lg">✅</div>
                    <p class="text-sm text-gray-500 font-medium">Kegiatan Selesai</p>
                </div>
                <p class="text-3xl font-bold text-gray-800 mt-4">
                    {{ $stats['kegiatan_selesai'] }}<span class="text-gray-400 text-xl">/{{ $stats['total_kegiatan'] }}</span>
                </p>
                @php
                    $persen = $stats['total_kegiatan'] > 0
                        ? round(($stats['kegiatan_selesai'] / $stats['total_kegiatan']) * 100)
                        : 0;
                @endphp
                <div class="w-full bg-gray-100 rounded-full h-2 mt-3">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $persen }}%"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="bg-amber-100 text-amber-600 rounded-full w-10 h-10 flex items-center justify-center text-lg">💰</div>
                    <p class="text-sm text-gray-500 font-medium">Saldo Bulan Ini</p>
                </div>
                <p class="text-3xl font-bold text-gray-800 mt-4">
                    Rp {{ number_format($stats['saldo'], 0, ',', '.') }}
                </p>
            </div>

        </div>

        {{-- Menu Navigasi ke Fitur Lain --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Menu</h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                <a href="{{ route('schedules.index') }}"
                   class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col items-center gap-2 hover:shadow-md hover:-translate-y-0.5 transition-all">
                    <span class="text-2xl">📅</span>
                    <span class="text-sm font-medium text-gray-700">Jadwal Belajar</span>
                </a>

                <a href="{{ route('activities.index') }}"
                   class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col items-center gap-2 hover:shadow-md hover:-translate-y-0.5 transition-all">
                    <span class="text-2xl">✅</span>
                    <span class="text-sm font-medium text-gray-700">Kegiatan Harian</span>
                </a>

                <a href="{{ route('finances.index') }}"
                   class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col items-center gap-2 hover:shadow-md hover:-translate-y-0.5 transition-all">
                    <span class="text-2xl">💰</span>
                    <span class="text-sm font-medium text-gray-700">Keuangan</span>
                </a>

                <a href="{{ route('categories.index') }}"
                   class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col items-center gap-2 hover:shadow-md hover:-translate-y-0.5 transition-all">
                    <span class="text-2xl">🏷️</span>
                    <span class="text-sm font-medium text-gray-700">Kategori</span>
                </a>

            </div>
        </div>

    </div>

</body>
</html>
