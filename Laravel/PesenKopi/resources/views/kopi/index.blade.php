<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOPI MENU</title>
</head>
<body>
    <div>
        <h1>Daftar Kopi</h1>
        <ul>
            @foreach ($kopi as $item)
                <li>{{ $item->nama_kopi }} - Rp {{ number_format($item->harga, 0, ',', '.') }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>
