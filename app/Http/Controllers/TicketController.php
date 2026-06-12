<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function store(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        
        if ($event->organizer_id === auth()->id()) {
            return redirect("/events/{$event->id}")
                ->with('error', 'You cannot buy tickets for your own event.');
        }

        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $soldTickets = $event->tickets()->sum('quantity');
        $remainingTickets = $event->total_tickets - $soldTickets;

        if ($data['quantity'] > $remainingTickets) {
            return redirect("/events/{$event->id}")
                ->with('error', 'Not enough tickets available.');
        }

        Ticket::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'quantity' => $data['quantity'],
            'total_price' => $event->ticket_price * $data['quantity'],
            'status' => 'paid',
        ]);

        return redirect("/events/{$event->id}")->with('success', 'Ticket Purchased!');
    }

    public function index()
    {
        $tickets = auth()->user()->tickets;

        return view('tickets.index', ['tickets' => $tickets,]);
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->delete();

        return redirect('/my-tickets')
            ->with('success', 'Ticket cancelled successfully.');
    }
}
