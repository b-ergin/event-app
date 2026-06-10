<x-app-layout>
    <x-slot name="header">
        <h2>Buyer Details</h2>
    </x-slot>

    <div class="p-6">

        <p>Event: {{ $event->title }}</p>

        <p>Name: {{ $ticket->user->name }}</p>

        <p>Email: {{ $ticket->user->email }}</p>

        <p>Quantity: {{ $ticket->quantity }}</p>

        <p>Total Paid: {{ $ticket->total_price }}</p>

        <p>Status: {{ $ticket->status }}</p>

        <p>Purchase ID: {{ $ticket->id }}</p>

        <a href="/events/{{ $event->id }}/buyers">
            Back to Buyers
        </a>

    </div>
</x-app-layout>