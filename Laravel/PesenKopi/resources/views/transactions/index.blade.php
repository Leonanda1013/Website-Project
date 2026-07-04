<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesan Kopi</title>
</head>
<body>
    <div>
        <h1>Pesan Kopi</h1>

    </div>
    <div>
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <label for="kopi_id">Pilih Kopi:</label>
            <select name="kopi_id" id="kopi_id" required>
                @foreach ($kopi as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kopi }} - Rp {{ number_format($item->harga, 0, ',', '.') }}</option>
                @endforeach
            </select>

            <label for="amount">Jumlah:</label>
            <input type="number" name="amount" id="amount" min="1" required>

            <label for="note">Catatan:</label>
            <textarea name="note" id="note"></textarea>

            <label for="date">Tanggal:</label>
            <input type="date" name="date" id="date" required>

            <button type="submit">Pesan</button>
        </form>
    </div>
</body>
</html>
