<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\Booking;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::latest()->paginate(10); // Fetch latest events with pagination
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $event = new Event();
        $event->title = $request->title;
        $event->user_id = $request->user_id;
        $event->capacity = $request->capacity;
        $event->description = $request->description;
        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index');
    }

    /**
     * Booking Event.
     */
    public function booking(Request $request)
    {

        //check if event already exit for the same user
        $event = Booking::where('user_id', Auth::user()->id)->where('event_id', $request->event_id)->first();

        if($event):
            return redirect()->back()->with('error', 'Event has been already booked.');
        endif;

        //
        $booking = new Booking();
        $booking->event_id = $request->event_id;
        $booking->user_id = $request->user_id;
        $booking->save();

        //update capacity
        $event = Event::findOrFail($request->event_id);
        $event->capacity = ($event->capacity - 1);
        $event->save();

        //Here we will write a function to send the email notification to the organizer that booking has been create by user 

        //Email


        return redirect()->route('events.index');
    }

}
