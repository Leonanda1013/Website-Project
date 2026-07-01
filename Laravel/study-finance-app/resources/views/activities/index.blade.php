<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Hari Ini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-2">
        <h1 class="text-2xl font-bold text-gray-800">📅 Kegiatan Hari Ini</h1>
        <a href="{{ route('activities.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
            + Tambah
        </a>
    </div>

    {{-- Tanggal hari ini --}}
    <p class="text-gray-400 text-sm mb-6">{{ now()->translatedFormat('l, d F Y') }}</p>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-200 rounded-lg px-4 py-3 mb-4 text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Statistik --}}
    <div class="grid grid-cols-3 gap-3 mb-6">
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Total</p>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-green-500">{{ $stats['done'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Selesai</p>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-gray-400">{{ $stats['skip'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Dilewati</p>
        </div>
    </div>

    {{-- Progress bar --}}
    @if($stats['total'] > 0)
        @php $percent = round(($stats['done'] / $stats['total']) * 100); @endphp
        <div class="mb-6">
            <div class="flex justify-between text-xs text-gray-400 mb-1">
                <span>Progress</span>
                <span>{{ $percent }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full transition-all"
                     style="width: {{ $percent }}%"></div>
            </div>
        </div>
    @endif

    {{-- List kegiatan --}}
    <div class="space-y-2">
        @forelse($activities as $activity)
            <div class="bg-white rounded-xl p-4 shadow-sm flex items-center gap-4
                        {{ $activity->status === 'done' ? 'opacity-60' : '' }}">

                {{-- Tombol Toggle Status --}}
                <form action="{{ route('activities.toggle', $activity) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-sm
                                   {{ $activity->status === 'done' ? 'bg-green-500 border-green-500 text-white' : '' }}
                                   {{ $activity->status === 'skip' ? 'bg-gray-300 border-gray-300 text-white' : '' }}
                                   {{ $activity->status === 'pending' ? 'border-gray-300 hover:border-indigo-400' : '' }}">
                        @if($activity->status === 'done') ✓
                        @elseif($activity->status === 'skip') –
                        @else <span class="w-3 h-3 rounded-full"></span>
                        @endif
                    </button>
                </form>

                {{-- Info Kegiatan --}}
                <div class="flex-1">
                    <p class="font-medium text-gray-800
                              {{ $activity->status === 'done' ? 'line-through text-gray-400' : '' }}">
                        {{ $activity->title }}
                    </p>
                    <div class="flex gap-3 text-xs text-gray-400 mt-1">
                        @if($activity->time)
                            <span>🕐 {{ \Carbon\Carbon::parse($activity->time)->format('H:i') }}</span>
                        @endif
                        @if($activity->note)
                            <span>📝 {{ $activity->note }}</span>
                        @endif
                    </div>
                </div>

                {{-- Badge Status --}}
                <span class="text-xs px-2 py-1 rounded-full
                    {{ $activity->status === 'done'    ? 'bg-green-100 text-green-600' : '' }}
                    {{ $activity->status === 'skip'    ? 'bg-gray-100 text-gray-400'  : '' }}
                    {{ $activity->status === 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}">
                    {{ $activity->status === 'done' ? 'Selesai' : ($activity->status === 'skip' ? 'Dilewati' : 'Pending') }}
                </span>

                {{-- Hapus --}}
                <form action="{{ route('activities.destroy', $activity) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus kegiatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-300 hover:text-red-400 text-lg">✕</button>
                </form>

            </div>
        @empty
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-3">🎉</p>
                <p>Belum ada kegiatan hari ini. Yuk tambahkan!</p>
            </div>
        @endforelse
    </div>

</div>
</body>
</html>
