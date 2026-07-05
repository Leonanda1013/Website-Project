<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Court</title>
</head>
<body>
    <h1>Edit Court</h1>
    <form action="{{ route('courts.update', $court->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $court->name }}" required>
        </div>
        <div>
            <label for="type_court_id">Type Court ID:</label>
            <select name="type_court_id" id="type_court_id" required>
                <option value="">Select a court type</option>
                @foreach ($courtTypes as $courtType)
                    <option value="{{ $courtType->id }}" {{ $court->type_court_id == $courtType->id ? 'selected' : '' }}>
                        {{ $courtType->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="{{ $court->price }}" required min="0">
        </div>
        <button type="submit">Update Court</button>
    </form>
</body>
</html>
