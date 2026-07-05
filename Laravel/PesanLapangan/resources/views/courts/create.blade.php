<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Court</title>
</head>
<body>
    <h1>Create Court</h1>
    <form action="{{ route('courts.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="type_court_id">Type Court ID:</label>
            <select name="type_court_id" id="type_court_id" required>
                <option value="">Select a court type</option>
                @foreach ($courtTypes as $courtType)
                    <option value="{{ $courtType->id }}">{{ $courtType->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required min="0">
        </div>
        <button type="submit">Create Court</button>
    </form>
</body>
</html>
