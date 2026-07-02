<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div>
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <a href="{{ route('categories.index') }}">← Kembali</a>
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}">
            </div>
            <div>
                <label>Type</label>
                <select name="type">
                    <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label>Icon</label>
                <input type="text" name="icon" value="{{ old('icon', $category->icon) }}">
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
