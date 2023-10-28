<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Booking</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('booking.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
        <form action="{{ route('booking.update',$booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Booking Name:</strong>
                        <input type="text" name="name" value="{{ $booking->name }}" class="form-control"
                            placeholder="Booking name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Booking date:</strong>
                        <input type="date" name="booking_date" class="form-control" placeholder="Booking Date"
                            value="{{ $booking->booking_date }}">
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
                            <option value="full_day" {{ $booking->booking_type == "full_day" ? 'selected' : ''}}>full_day</option>
                            <option value="half_day" {{ $booking->booking_type == "half_day" ? 'selected' : ''}}>half_day</option>
                            <option value="shift" {{ $booking->booking_type == "shift" ? 'selected' : ''}}>shift</option>
</select>
                        @error('booking_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Booking shift:</strong>
                        <select type="text" name="shift" id="shift" class="form-control" placeholder="Booking shift"  id="shift_dv" {{ $booking->booking_type == "shift" ? '' : 'disabled'}}>
                            <option value="">--select--</option>
                            <option value="morning" {{ $booking->shift == "morning" ? 'selected' : ''}}>morning</option>
                            <option value="afternoon" {{ $booking->shift == "afternoon" ? 'selected' : ''}} >afternoon</option>
                            <option value="evening" {{ $booking->shift == "evening" ? 'selected' : ''}} >evening</option>
                        </select>
                        @error('shift')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary ml-3">Update</button>
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