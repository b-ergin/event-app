<h1>Events</h1>

<a href="/events/create">Create Event</a>

@foreach ($events as $event)
    <div>
        <h2>
            <a href="/events/{{ $event->id }}">
                {{ $event->title }}
            </a>
        </h2>
        <p>{{ $event->description }}</p>
        <p>Venue: {{ $event->venue }}</p>
        <p>Date: {{ $event->event_date }}</p>
        <p>Price: {{ $event->ticket_price }}</p>
    </div>
@endforeach