<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Belajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">📚 Jadwal Belajar</h1>
            <a href="{{ route('schedules.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                + Tambah Jadwal
            </a>
        </div>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-200 rounded-lg px-4 py-3 mb-6 text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- List jadwal per hari --}}
        @php
            $days = [
                'monday'    => 'Senin',
                'tuesday'   => 'Selasa',
                'wednesday' => 'Rabu',
                'thursday'  => 'Kamis',
                'friday'    => 'Jumat',
                'saturday'  => 'Sabtu',
                'sunday'    => 'Minggu',
            ];
        @endphp

        @foreach($days as $key => $label)
            @php $daySchedules = $schedules->where('day_of_week', $key); @endphp

            @if($daySchedules->isNotEmpty())
                <div class="mb-6">
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">
                        {{ $label }}
                    </h2>
                    <div class="space-y-2">
                        @foreach($daySchedules as $schedule)
                            <div class="bg-white rounded-xl p-4 shadow-sm flex items-center gap-4"
                                 style="border-left: 4px solid {{ $schedule->color }}">

                                {{-- Jam --}}
                                <div class="text-sm text-gray-400 w-28 shrink-0">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                    –
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                </div>

                                {{-- Info --}}
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $schedule->subject }}</p>
                                    @if($schedule->description)
                                        <p class="text-sm text-gray-400">{{ $schedule->description }}</p>
                                    @endif
                                </div>

                                {{-- Aksi --}}
                                <div class="flex gap-3 text-sm shrink-0">
                                    <a href="{{ route('schedules.edit', $schedule) }}"
                                       class="text-indigo-500 hover:underline">Edit</a>

                                    <form action="{{ route('schedules.destroy', $schedule) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-400 hover:underline">Hapus</button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Kalau belum ada jadwal --}}
        @if($schedules->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-3">📭</p>
                <p>Belum ada jadwal. Tambahkan jadwal pertamamu!</p>
            </div>
        @endif

    </div>
</body>
</html>
