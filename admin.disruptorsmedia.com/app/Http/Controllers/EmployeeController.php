<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Support\Facades\Log; // Import Log facade

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $data  = [
            "title"=>"Employee Portal | Login"
        ];
        return view("employee/login", $data);
    }

    public function dashboard(){
        $data  = [
            "title"=>"Employee Portal |Dashboard"
        ];
        $user = auth()->user();
     
        if ($user) {
            return view("employee/dashboard", $data);
        } else {
            return redirect('/');
        }
    }

    public function about(){
        $data  = [
            "title"=>"Employee Portal |About"
        ];
        return view("employee/about", $data);
    }
    public function benefits(){
        $data  = [
            "title"=>"Employee Portal |Benefits"
        ];
        return view("employee/benefits", $data);
    }
    public function evp(){
        $data = [
            "title"=> "Employee Portal | Benefits"
        ];
        return view("employee/evp", $data);
    }
    public function pay_structure(){
        $data = [
        "title"=> "Employee Portal | Pay Structure"
        ];
        return view("employee/pay_structure", $data);
    }
    public function events(Request $request)
    {
        try {
            if ($request->ajax()) {
                // If it's an Ajax request, return events in JSON format
                $events = Event::all();
                $eventDates = $events->pluck('start_date')->unique()->toArray();
                return response()->json([
                    'events' => $events,
                    'eventDates' => $eventDates,
                ]);
            } else {
                // If it's not an Ajax request, render the Blade view as usual
                $events = Event::all();
                $data = [
                    "title" => "Employee Portal | Events",
                    "events" => $events,
                ];
                // Pass the data to the view
                return \View::make('employee.events')->with($data);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error fetching events: ' . $e->getMessage());
            // You can customize the error response based on your needs
            if ($request->ajax()) {
                return response()->json(['error' => 'Error fetching events. Please try again.'], 500);
            } else {
                return back()->with(['error' => 'Error fetching events. Please try again.']);
            }
        }
    }

    public function notification(){
        $data = [
            "title"=> "Employee Portal | Notifications"
        ];
        return view("employee/notification", $data);
    }
    public function messages(){
        $data = [
            "title"=> "Employee Portal | Messages"
        ];
        return view("employee/message", $data);
    }
    public function qrcode(){
        $data = [
            "title"=> "Employee Portal | QR CODE"
        ];
        return view("employee/qr_code", $data);
    }
    public function event_inner(){
        $data = [
            "title"=> "Event",
        ];
        return view("employee/event-inner", $data);
    }
}
