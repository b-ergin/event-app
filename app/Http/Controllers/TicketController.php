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
}
