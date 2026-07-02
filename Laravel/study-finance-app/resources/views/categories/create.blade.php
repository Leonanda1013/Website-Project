<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-lg mx-auto">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-gray-600">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Kategori</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400
                              @error('name') border-red-400 @enderror"
                       placeholder="Contoh: Makan, Transport, Gaji...">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipe --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                <select name="type"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="income"  {{ old('type') == 'income'  ? 'selected' : '' }}>💵 Pemasukan</option>
                    <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>💸 Pengeluaran</option>
                </select>
            </div>

            {{-- Icon --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Icon Emoji <span class="text-gray-400">(opsional)</span>
                </label>
                <input type="text"
                       name="icon"
                       value="{{ old('icon') }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                       placeholder="Contoh: 🍔 🚗 💼">
                <p class="text-xs text-gray-400 mt-1">Copy-paste emoji dari keyboard atau website</p>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                Simpan Kategori
            </button>

        </form>
    </div>

</div>
</body>
</html>
