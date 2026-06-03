<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.index', ['events' => $events]);
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'event_date' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
        ]);

        $data['organizer_id'] = auth()->id();

        Event::create($data);

        return redirect('/events');
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'event_date' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
        ]);

        $event->update($data);

        return redirect("/events/{$event->id}");
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return redirect('/events');
    }
}