<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Booking details</h2>
                </div>
                <div class="pull-right mb-2">
                    
                    <a class="btn btn-info" href="{{ route('dashboard') }}"> Dashboard</a>
                    <a class="btn btn-success" href="{{ route('booking.create') }}"> Create Booking</a>
                </div>
                
            </div>
            
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Booking Name</th>
                    <th>Booking Date</th>
                    <th>Booking Type</th>
                    <th>Booking shift</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($booking->booking_date)); }}</td>
                        <td>{{ $booking->booking_type }}</td>
                        <td>{{ $booking->shift }}</td>
                        <td>
                            <form action="{{ route('booking.destroy',$booking->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('booking.edit',$booking->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
       
    </div>
</body>
</html>