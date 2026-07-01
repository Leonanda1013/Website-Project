<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1>
        Halo, Vincentius!
    </h1>

    <div>
        <p>Jadwal Hari Ini</p>
        {{-- Blade sintask untuk echo variable: {{ }} --}}
        <p>{{ $stats['jadwal_hari_ini'] }}</p>
    </div>

    <div>
        <p>Kegiatan Selesai</p>
        <p>{{ $stats['kegiatan_selesai'] }}/{{ $stats['total_kegiatan'] }}</p>
    </div>
    <div>
        <p>Saldo Bulan Ini</p>
        <p>Rp {{ number_format($stats['saldo'], 0, ',', '.') }}</p>
    </div>

</body>
</html>
