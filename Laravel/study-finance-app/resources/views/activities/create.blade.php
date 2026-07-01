<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-lg mx-auto">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('activities.index') }}" class="text-gray-400 hover:text-gray-600">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Kegiatan</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('activities.store') }}" method="POST">
            @csrf

            {{-- Judul --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400
                              @error('title') border-red-400 @enderror"
                       placeholder="Contoh: Belajar Laravel, Olahraga, dll">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal & Jam --}}
            <div class="mb-4 grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date"
                           name="date"
                           value="{{ old('date', today()->format('Y-m-d')) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Jam <span class="text-gray-400">(opsional)</span>
                    </label>
                    <input type="time"
                           name="time"
                           value="{{ old('time') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
            </div>

            {{-- Catatan --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Catatan <span class="text-gray-400">(opsional)</span>
                </label>
                <textarea name="note"
                          rows="2"
                          class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                          placeholder="Catatan tambahan...">{{ old('note') }}</textarea>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                Tambahkan
            </button>
        </form>
    </div>

</div>
</body>
</html>
