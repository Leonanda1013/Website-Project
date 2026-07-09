<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <div>
        <button type="button" onclick="window.location.href='{{route('products.create')}}'">Create Product</button>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
