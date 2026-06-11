<x-app-layout>
    <x-slot name="header">
        <h2>Events</h2>
    </x-slot>

    <div class="p-6">

        <form method="GET" action="/events">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search events..."
            >

            <button type="submit">
                Search
            </button>
        </form>

        @if ($search)
            <a href="/events">Clear Search</a>
        @endif

        <hr>
        
        @if ($events->isEmpty())
            <p>No events found.</p>
        @else

            @foreach ($events as $event)
                @if ($event->image)
                    <img
                        src="{{ asset('storage/' . $event->image) }}"
                        alt="{{ $event->title }}"
                        width="150"
                    >
                @endif

                <h2>
                    <a href="/events/{{ $event->id }}" style="background-color: teal;">
                        {{ $event->title }}
                    </a>
                </h2>

                <p>{{ $event->description }}</p>
                <p>Venue: {{ $event->venue }}</p>
                <p>Date: {{ $event->event_date }}</p>
                <p>Price: {{ $event->ticket_price }}</p>

                <hr>

            @endforeach
        @endif

    </div>
</x-app-layout>