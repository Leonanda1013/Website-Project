<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Borrow Books</title>
</head>
<body>
    <h1>Borrow a Book</h1>
    <form action="{{ route('borrows.store') }}" method="POST">
        @csrf
        <div>
            <label for="book_id">Book:</label>
            <select name="book_id" id="book_id" required>
                <option value="">Select a book</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="member_id">Member:</label>
            <select name="member_id" id="member_id" required>
                <option value="">Select a member</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="borrow_date">Borrow Date:</label>
            <input type="date" name="borrow_date" id="borrow_date" required>
        </div>
        <button type="submit">Borrow Book</button>
    </form>
</body>
</html>
