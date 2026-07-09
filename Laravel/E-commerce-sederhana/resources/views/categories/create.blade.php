<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories Create</title>
</head>
<body>
    <div>
        <h1>Create Category</h1>
    </div>
    <div>
        <form action="{{ route('categories.store')}}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
