<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">💰 Keuangan Pribadi</h1>
        <a href="{{ route('finances.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
            + Tambah Transaksi
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 rounded-lg px-4 py-3 mb-6 text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Kartu Ringkasan --}}
    <div class="grid grid-cols-3 gap-4 mb-8">

        <div class="bg-white rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-400">💵 Total Pemasukan</p>
            <p class="text-2xl font-bold text-green-500 mt-1">
                Rp {{ number_format($totalIncome, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-400">💸 Total Pengeluaran</p>
            <p class="text-2xl font-bold text-red-400 mt-1">
                Rp {{ number_format($totalExpense, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-400">🏦 Saldo</p>
            <p class="text-2xl font-bold mt-1
                      {{ $balance >= 0 ? 'text-indigo-600' : 'text-red-500' }}">
                Rp {{ number_format($balance, 0, ',', '.') }}
            </p>
        </div>

    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-400 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Keterangan</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Tipe</th>
                    <th class="px-4 py-3 text-right">Nominal</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50">

                    {{-- Tanggal --}}
                    <td class="px-4 py-3 text-gray-400">
                        {{ $transaction->date->format('d M Y') }}
                    </td>

                    {{-- Keterangan --}}
                    <td class="px-4 py-3 text-gray-700">
                        {{ $transaction->description ?? '-' }}
                    </td>

                    {{-- Kategori --}}
                    <td class="px-4 py-3 text-gray-600">
                        {{ $transaction->category->name }}
                    </td>

                    {{-- Tipe --}}
                    <td class="px-4 py-3">
                        @if($transaction->type === 'income')
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                                Pemasukan
                            </span>
                        @else
                            <span class="bg-red-100 text-red-400 px-2 py-1 rounded-full text-xs">
                                Pengeluaran
                            </span>
                        @endif
                    </td>

                    {{-- Nominal --}}
                    <td class="px-4 py-3 text-right font-medium
                               {{ $transaction->type === 'income' ? 'text-green-500' : 'text-red-400' }}">
                        {{ $transaction->type === 'income' ? '+' : '-' }}
                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('finances.edit', $transaction) }}"
                               class="text-indigo-400 hover:underline">Edit</a>

                            <form action="{{ route('finances.destroy', $transaction) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12 text-gray-400">
                        Belum ada transaksi. Tambahkan transaksi pertamamu!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
