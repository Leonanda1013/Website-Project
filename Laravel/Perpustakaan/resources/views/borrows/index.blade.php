<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Borrow Books</title>
</head>
<body>
    <h1>Borrow Books</h1>
    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Member</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->member->name }}</td>
                    <td>{{ $borrow->borrow_date }}</td>
                    <td>{{ $borrow->return_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('borrows.create') }}">Borrow a Book</a>
</body>
</html>
