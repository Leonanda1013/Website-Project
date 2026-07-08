<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Products</title>
</head>
<body>
    <div>
        <h1>Create Product</h1>
    </div>
    <div>
        <form action="{{ route('products.store')}}" method="POST">
            @csrf
            <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            </div>
            <div>
            <label for="stock">stock</label>
            <input type="number" name="stock" required>
            </div>
            <div>
            <label for="price">price</label>
            <input type="number" name="price">
            </div>
            <div>
            <select name="category_id" id="category_id">
                <option value="">Select Option</option>
                @foreach ( $categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            </div>
        </form>
    </div>
</body>
</html>
