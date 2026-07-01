<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-lg mx-auto">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('schedules.index') }}" class="text-gray-400 hover:text-gray-600">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        {{--
            Perbedaan dengan create:
            1. action → route update, kirim $schedule (biar tau mau update ID berapa)
            2. @method('PUT') → karena HTML form tidak support PUT
            3. value setiap input diisi dari $schedule->kolom
        --}}
        <form action="{{ route('schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Subject --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Mata Pelajaran / Topik
                </label>
                <input type="text"
                       name="subject"
                       value="{{ old('subject', $schedule->subject) }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400
                              @error('subject') border-red-400 @enderror">
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hari --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                <select name="day_of_week"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @foreach([
                        'monday'    => 'Senin',
                        'tuesday'   => 'Selasa',
                        'wednesday' => 'Rabu',
                        'thursday'  => 'Kamis',
                        'friday'    => 'Jumat',
                        'saturday'  => 'Sabtu',
                        'sunday'    => 'Minggu'
                    ] as $val => $label)
                        <option value="{{ $val }}"
                            {{--
                                old() → kalau validasi gagal, pakai input terakhir user
                                $schedule->day_of_week → kalau baru buka form, pakai data dari DB
                            --}}
                            {{ old('day_of_week', $schedule->day_of_week) == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jam --}}
            <div class="mb-4 grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                    <input type="time"
                           name="start_time"
                           value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                    <input type="time"
                           name="end_time"
                           value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
            </div>

            {{-- Warna --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Warna Label</label>
                <input type="color"
                       name="color"
                       value="{{ old('color', $schedule->color) }}"
                       class="h-10 w-20 border rounded-lg cursor-pointer">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi <span class="text-gray-400">(opsional)</span>
                </label>
                <textarea name="description"
                          rows="2"
                          class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                          placeholder="Catatan tambahan...">{{ old('description', $schedule->description) }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                    Simpan Perubahan
                </button>
                <a href="{{ route('schedules.index') }}"
                   class="flex-1 text-center bg-gray-100 text-gray-600 py-2 rounded-lg text-sm font-medium hover:bg-gray-200">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>
</body>
</html>
