<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courts</title>
</head>
<body>
    <h1>Courts</h1>
    <a href="{{ route('courts.create') }}">Create New Court</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type Court ID</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courts as $court)
                <tr>
                    <td>{{ $court->id }}</td>
                    <td>{{ $court->name }}</td>
                    <td>{{ $court->type_court_id }}</td>
                    <td>{{ $court->price }}</td>
                    <td>
                        <a href="{{ route('courts.show', $court->id) }}">View</a>
                        <a href="{{ route('courts.edit', $court->id) }}">Edit</a>
                        <form action="{{ route('courts.destroy', $court->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" onclick="window.location.href='{{ route('courts.create') }}'">Tambah Court</button>
</body>
</html>
