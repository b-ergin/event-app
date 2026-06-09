<x-app-layout>
    <x-slot name="header">
        <h2>My Events</h2>
    </x-slot>

    <div class="p-6">

        @foreach ($events as $event)

            <h2>
                <a href="/events/{{ $event->id }}">
                    {{ $event->title }}
                </a>
            </h2>

            <p>Venue: {{ $event->venue }}</p>

            <p>Tickets Sold: {{ $event->tickets()->sum('quantity') }}</p>

            <p>Revenue: ${{ $event->tickets()->sum('total_price') }}</p>

            <p>
                Remaining Tickets:
                {{ $event->total_tickets - $event->tickets()->sum('quantity') }}
            </p>

            <hr>

        @endforeach

    </div>
</x-app-layout>