<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use DB;
class BookingController extends Controller
{
    
    public function index()
    {
        $booking = Booking::latest()->paginate(5);
    
        return view('booking.index',compact('booking'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
   
    public function create()
    {
        return view('booking.create');
    }
    
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'booking_date' => 'required',
            'booking_type' => 'required',
        ]);
       // dd($request['booking_type']);
        switch($request['booking_type']) {
            case("full_day"):
                DB::enableQueryLog();
                $existFullBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
                ->where('booking_type', $request['booking_type'])
                ->orwhere('booking_type','half_day')
                ->whereNull('shift')
                ->first();
                $quries = DB::getQueryLog();

//dd($quries);
                if($existFullBooking){
                    return redirect()->route('booking.create')
                    ->with('error','Booking already exist.');
                }else{
                    Booking::create($request->all());
             
                    return redirect()->route('booking.index')
                                    ->with('success','Booking created successfully.');
                }
                break;
 
            case('half_day'):
                DB::enableQueryLog();
                $existFullBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
                ->where('booking_type', $request['booking_type'])
                ->orwhere('booking_type','full_day')
                ->orwhereNotNull('shift')
                ->first();
                $quries = DB::getQueryLog();

                //dd($quries);
                if($existFullBooking){
                    return redirect()->route('booking.create')
                    ->with('error','Booking already exist.');
                }else{
                    Booking::create($request->all());
             
                    return redirect()->route('booking.index')
                                    ->with('success','Booking created successfully.');
                }
                break;
            case('shift'):
                $existFullBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
                ->where('booking_type','!=' ,'half_day')
                ->where('booking_type', '!=' ,'full_day')
                ->where('shift',$request['shift'])
                ->first();
                    if($existFullBooking){
                        return redirect()->route('booking.create')
                        ->with('error','This Shift booked.');
                    }else{
                        Booking::create($request->all());
                
                        return redirect()->route('booking.index')
                                        ->with('success','Booking created successfully.');
                    }
                    break;
 
            default:
            return redirect()->route('booking.create')
            ->with('error','Something went wrong.');
        }
 

        
        //dd($exisBooking);

        
    
    }
     
    
    public function show(Booking $booking)
    {
        return view('booking.show',compact('booking'));
    } 
     
   
    public function edit(Booking $booking)
    {
        return view('booking.edit',compact('booking'));
    }
    
    
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => 'required',
            'booking_date' => 'required',
            'booking_type' => 'required',
        ]);

        switch($request['booking_type']) {
            case("full_day"):
                $existFullBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
                ->where('booking_type', $request['booking_type'])
                ->orwhere('booking_type','half_day')
                ->whereNull('shift')
                ->first();
                //dd($existFullBooking);
                if($existFullBooking){
                    return redirect()->route('booking.create')
                    ->with('error','Full day Booking already exist.');
                }else{
                    $booking->update($request->all());
             
                    return redirect()->route('booking.index')
                                    ->with('success','Booking updated successfully.');
                }
                break;
 
            case('half_day'):
                $existFullBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
                ->where('booking_type', $request['booking_type'])
                ->orwhere('booking_type','full_day')
                ->orwhereNotNull('shift')
                ->first();
                if($existFullBooking){
                    return redirect()->route('booking.create')
                    ->with('error','Booking already exist.');
                }else{
                    $booking->update($request->all());
             
                    return redirect()->route('booking.index')
                                    ->with('success','Booking updated successfully.');
                }
                break;
            case('shift'):
                $existFullBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
                ->where('booking_type','!=' ,'half_day')
                ->where('booking_type', '!=' ,'full_day')
                ->where('shift',$request['shift'])
                ->first();
                    if($existFullBooking){
                        return redirect()->route('booking.create')
                        ->with('error','This Shift booked.');
                    }else{
                        $booking->update($request->all());
                
                        return redirect()->route('booking.index')
                                        ->with('success','Booking updated successfully.');
                    }
                    break;
 
            default:
            return redirect()->route('booking.create')
            ->with('error','Something went wrong.');
        }

        // $exisBooking = DB::table('bookings')->where('booking_date', $request['booking_date'])
        // ->where('shift', $request['shift'])
        // ->first();
        // if($exisBooking){
        //     return redirect()->route('booking.create')
        //     ->with('error','Booking exist on that shift.');
        // }else{
        //     $booking->update($request->all());
        // }
    
        // return redirect()->route('booking.index')
        //                 ->with('success','Booking updated successfully');
    }
    
    
    public function destroy(Booking $booking)
    {
        $booking->delete();
    
        return redirect()->route('booking.index')
                        ->with('success','Booking deleted successfully');
    }}
