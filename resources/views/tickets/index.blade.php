<x-app-layout>
    <x-slot name="header">
        <h2>My Tickets</h2>
    </x-slot>

    <div class="p-6">

        @foreach ($tickets as $ticket)

            <h2>{{ $ticket->event->title }}</h2>

            <p>Quantity: {{ $ticket->quantity }}</p>

            <p>Total Price: {{ $ticket->total_price }}</p>

            <p>Status: {{ $ticket->status }}</p>

            <hr>

        @endforeach

    </div>
</x-app-layout>