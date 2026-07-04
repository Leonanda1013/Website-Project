<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kopi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-2xl mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Tambah Kopi</h1>
        <form action="{{ route('kopi.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="nama_kopi" class="block text-gray-700 font-semibold mb-2">Nama Kopi:</label>
                <input type="text" name="nama_kopi" id="nama_kopi" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-gray-700 font-semibold mb-2">Harga:</label>
                <input type="number" name="harga" id="harga" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Simpan</button>
        </form>
    </div>
</body>
</html>
