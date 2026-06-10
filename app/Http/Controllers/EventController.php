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

        $soldTickets = $event->tickets()->sum('quantity');
        $remainingTickets = $event->total_tickets - $soldTickets;

        return view('events.show', [
            'event' => $event,
            'remainingTickets' => $remainingTickets,
        ]);
    }

    public function create()
    {
        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        return view('events.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

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

        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

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

        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $event->delete();

        return redirect('/events');
    }

    public function myEvents()
    {
        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        $events = auth()->user()->events;

        return view('events.my-events', [
            'events' => $events,
        ]);
    }

    public function buyers(string $id)
    {
        $event = Event::findOrFail($id);

        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $tickets = $event->tickets;

        return view('events.buyers', [
            'event' => $event,
            'tickets' => $tickets,
        ]);
    }

    public function buyerDetails(string $eventId, string $ticketId)
    {
        $event = Event::findOrFail($eventId);

        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }

        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $ticket = $event->tickets()->findOrFail($ticketId);

        return view('events.buyer-details', [
            'event' => $event,
            'ticket' => $ticket,
        ]);
    }
}