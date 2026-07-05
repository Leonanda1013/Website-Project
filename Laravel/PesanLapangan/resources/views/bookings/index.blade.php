<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking</title>
</head>
<body>
    <h1>Booking</h1>
    <table>
        <tr>
            <th>NO</th>
            <th>Customer</th>
            <th>Court</th>
            <th>date</th>
            <th>start time</th>
            <th>end time</th>
            <th>status</th>
            <th>action</th>
        </tr>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$booking->customer_name}}</td>
                    <td>{{$booking->court->name}}</td>
                    <td>{{$booking->booking_date}}</td>
                    <td>{{$booking->start_time}}</td>
                    <td>{{$booking->end_time}}</td>
                    <td>{{$booking->status}}</td>
                    <td>
                        <a href="{{ route('courts.show', $booking->id) }}">View</a>
                        <a href="{{ route('courts.edit', $booking->id) }}">Edit</a>
                        <form action="{{ route('courts.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                    </td>

                </tr>
            @endforeach
    </table>
    <button type="button" onclick="window.location.href='{{ route('bookings.create') }}'">create booking</button>
</body>
</html>
