<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Catgories</title>
</head>
<body>
    <div>
        <h1>Categories</h1>
    </div>
    <div>
        <button type="button" onclick="window.location.href='{{route('categories.create')}}'">Tambah Category</button>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                <th>NO</th>
                <th>Name</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <button type="button" onclick="window.location.href='{{route('categories.edit',$category->id)}}'">Edit</button>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
