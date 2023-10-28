<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Booking</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('booking.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Booking Name:</strong>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Booking Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Booking Date:</strong>
                        <input type="date" name="booking_date" class="form-control" placeholder="Booking Date">
                        @error('booking_date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Booking type:</strong>
                        <select type="text" name="booking_type" id="booking_type" class="form-control" placeholder="Booking Type">
                            <option value="">--select--</option>
                            <option value="full_day">full_day</option>
                            <option value="half_day">half_day</option>
                            <option value="shift">shift</option>
</select>
                        @error('booking_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" id="shift_dv" disabled>
                    <div class="form-group">
                        <strong>Shift:</strong>
                        <select type="text" disabled name="shift" id="shift" class="form-control" placeholder="Booking shift">
                            <option value="">--select--</option>
                            <option value="morning">morning</option>
                            <option value="afternoon">afternoon</option>
                            <option value="evening">evening</option>
</select>
                        @error('shift')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary ml-3">Add Booking</button>
            </div>
        </form>
    </div>
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</body>
<script>
    $('#booking_type').on('change', function() {
        if(this.value == "shift"){
            $("#shift").attr("disabled", false);
        }else{
            document.getElementById("shift").selectedIndex = "0";
            $("#shift").attr("disabled", true);
        }
    });
    </script>
</html>
