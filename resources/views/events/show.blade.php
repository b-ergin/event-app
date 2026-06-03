<h1>{{ $event->title }}</h1>

<p>{{ $event->description }}</p>

<p>Venue: {{ $event->venue }}</p>

<p>Date: {{ $event->event_date }}</p>

<p>Price: {{ $event->ticket_price }}</p>

<a href="/events/{{ $event->id }}/edit">Edit Event</a>

<form method="POST" action="/events/{{ $event->id }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Delete Event
    </button>
</form>