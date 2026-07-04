<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Member</title>
</head>
<body>
    <div>
        <h1>Create Member</h1>
        <form action="{{ route('members.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone">
            </div>
            <button type="submit">Create Member</button>
        </form>
    </div>
</body>
</html>
