<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🏷️ Kategori</h1>
        <a href="{{ route('categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
            + Tambah Kategori
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 rounded-lg px-4 py-3 mb-6 text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-6">

        {{-- Kolom Pemasukan --}}
        <div>
            <h2 class="text-sm font-bold text-green-600 uppercase tracking-widest mb-3">
                💵 Pemasukan
            </h2>
            <div class="space-y-2">
                @forelse($incomeCategories as $category)
                    <div class="bg-white rounded-xl px-4 py-3 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">{{ $category->icon ?? '📁' }}</span>
                            <span class="text-sm font-medium text-gray-700">{{ $category->name }}</span>
                        </div>
                        <div class="flex gap-3 text-sm">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="text-indigo-400 hover:underline">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl px-4 py-6 text-center text-gray-400 text-sm">
                        Belum ada kategori pemasukan
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Kolom Pengeluaran --}}
        <div>
            <h2 class="text-sm font-bold text-red-400 uppercase tracking-widest mb-3">
                💸 Pengeluaran
            </h2>
            <div class="space-y-2">
                @forelse($expenseCategories as $category)
                    <div class="bg-white rounded-xl px-4 py-3 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">{{ $category->icon ?? '📁' }}</span>
                            <span class="text-sm font-medium text-gray-700">{{ $category->name }}</span>
                        </div>
                        <div class="flex gap-3 text-sm">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="text-indigo-400 hover:underline">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl px-4 py-6 text-center text-gray-400 text-sm">
                        Belum ada kategori pengeluaran
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
</body>
</html>
