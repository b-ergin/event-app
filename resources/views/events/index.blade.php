<x-app-layout>
    <x-slot name="header">
        <h2>Events</h2>
    </x-slot>

    <div class="p-6">

        <hr>

        @foreach ($events as $event)

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

    </div>
</x-app-layout>