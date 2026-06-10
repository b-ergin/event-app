<x-app-layout>
    <x-slot name="header">
        <h2>My Events</h2>
    </x-slot>

    <div class="p-6">

        @if ($events->isEmpty())
            <p>You have not created any events yet.</p>
        @else
            @foreach ($events as $event)

                <h2>
                    <a href="/events/{{ $event->id }}">
                        {{ $event->title }}
                    </a>
                </h2>

                <p>Venue: {{ $event->venue }}</p>

                <p>Tickets Sold: {{ $event->tickets()->sum('quantity') }}</p>

                <p>Revenue: {{ $event->tickets()->sum('total_price') }}</p>

                <p>
                    Remaining Tickets:
                    {{ $event->total_tickets - $event->tickets()->sum('quantity') }}
                </p>

                <a href="/events/{{ $event->id }}/buyers">View Buyers</a>

                <hr>

            @endforeach
        @endif

    </div>
</x-app-layout>