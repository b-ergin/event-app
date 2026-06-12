<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
class EventController extends Controller
{
    public function index()
    {
        $search = request('search');

        $events = Event::where('status', 'published')
            ->where('event_date', '>=', now());

        if ($search) {
            $events->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%");
            });
        }

        $events = $events->paginate(5)->withQueryString();

        return view('events.index', ['events' => $events, 'search' =>$search,]);
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
        $this->requireOrganizer();
        $categories = Category::all();


        return view('events.create',['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->requireOrganizer();

        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'description' => 'required',
            'venue' => 'required',
            'event_date' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event-images', 'public');
        }

        $data['organizer_id'] = auth()->id();

        Event::create($data);

        return redirect('/events');
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        $this->requireOrganizer();
        $this->requireEventOwner($event);

        $categories = Category::all();

        return view('events.edit', ['event' => $event, 'categories' => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $this->requireOrganizer();
        $this->requireEventOwner($event);

        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'description' => 'required',
            'venue' => 'required',
            'event_date' => 'required|date',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $data['image'] = $request->file('image')->store('event-images', 'public');
        }

        $event->update($data);

        return redirect("/events/{$event->id}");
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        $this->requireOrganizer();
        $this->requireEventOwner($event);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
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

        $this->requireOrganizer();
        $this->requireEventOwner($event);

        $tickets = $event->tickets;

        return view('events.buyers', [
            'event' => $event,
            'tickets' => $tickets,
        ]);
    }

    public function buyerDetails(string $eventId, string $ticketId)
    {
        $event = Event::findOrFail($eventId);

        $this->requireOrganizer();
        $this->requireEventOwner($event);

        $ticket = $event->tickets()->findOrFail($ticketId);

        return view('events.buyer-details', [
            'event' => $event,
            'ticket' => $ticket,
        ]);
    }

    private function requireOrganizer()
    {
        if (auth()->user()->role !== 'organizer') {
            abort(403);
        }
    }

    private function requireEventOwner(Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }
    }
}