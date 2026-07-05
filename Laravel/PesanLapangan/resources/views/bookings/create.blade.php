<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Booking</title>
</head>
<body>
    <h1>Create Booking</h1>
    <form action="{{ route('bookings.store')}}" method="POST">
        @csrf
    <div>
        <label for="customer_name">Customer name</label>
        <input type="text" name="customer_name" required>
        <label for="court">Court</label>
        <select name="court_id" id="court_id" required>
            <option value="">Select Court</option>
            @foreach ($courts as $court)
                <option value="{{$court->id}}">{{$court->name}}</option>
            @endforeach
        </select>
        <label for="booking_date">Date</label>
        <input type="date" name="booking_date" required>
        <label for="start_time">time</label>
        <input type="time" name="start_time" required>
    </div>
    <button type="submit">Submit</button>
    </form>
</body>
</html>
