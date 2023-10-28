@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    You are Logged In
                    <br>
                    <div class="pull-right mb-2">
                    <a class="btn btn-info" href="{{ route('booking.index') }}"> Booking</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection