<x-app-layout>
    <x-slot name="header">
        <h2>{{ $event->title }}</h2>
    </x-slot>

    <div class="p-6">

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

        @if ($event->image)
            <img
                src="{{ asset('storage/' . $event->image) }}"
                alt="{{ $event->title }}"
                width="300"
            >
        @endif

        <p>{{ $event->description }}</p>

        <p>Category: {{ $event->category ? $event->category->name : 'Uncategorized' }}</p>

        <p>Venue: {{ $event->venue }}</p>

        <p>Date: {{ $event->event_date }}</p>

        <p>Price: {{ $event->ticket_price }}</p>

        <p>Remaining Tickets: {{ $remainingTickets }}</p>

        <p>
            <a href="/events">Back to Events</a>
        </p>

        @auth
            <a href="/my-tickets">My Tickets</a>
        @endauth

        @auth
            @if ($event->organizer_id === auth()->id())
                <p>You are the organizer of this event.</p>
            @else
                <h2>Buy Tickets</h2>

                <form method="POST" action="/events/{{ $event->id }}/tickets">
                    @csrf

                    <div>
                        <label>Quantity</label>
                        <input type="number" name="quantity" min="1" value="1">
                    </div>

                    <button type="submit">
                        Buy Ticket
                    </button>
                </form>
            @endif
        @endauth

        @guest
            <p>
                <a href="{{ route('login') }}">
                    Login to Buy Tickets
                </a>
            </p>    
        @endguest

        @if (auth()->check() && auth()->user()->role === 'organizer' && $event->organizer_id === auth()->id())

            <a href="/events/{{ $event->id }}/edit">
                Edit Event
            </a>

            <form method="POST" action="/events/{{ $event->id }}">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Delete Event
                </button>
            </form>

        @endif

    </div>
</x-app-layout>