<h1>{{ $event->title }}</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

<p>{{ $event->description }}</p>

<p>Venue: {{ $event->venue }}</p>

<p>Date: {{ $event->event_date }}</p>

<p>Price: {{ $event->ticket_price }}</p>
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

@if (auth()->check() && auth()->user()->role === 'organizer' && $event->organizer_id === auth()->id())
    <a href="/events/{{ $event->id }}/edit">Edit Event</a>

    <form method="POST" action="/events/{{ $event->id }}">
        @csrf
        @method('DELETE')

        <button type="submit">
            Delete Event
        </button>
    </form>
@endif    