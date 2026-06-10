<h1>Edit Event</h1>

<form method="POST" action="/events/{{ $event->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{ $event->title }}">
    </div>

    <div>
        <label>Description</label>
        <textarea name="description">{{ $event->description }}</textarea>
    </div>

    <div>
        <label>Venue</label>
        <input type="text" name="venue" value="{{ $event->venue }}">
    </div>

    <div>
        <input
        type="datetime-local"
        name="event_date"
        value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}"
        >
    </div>

    <div>
        <label>Ticket Price</label>
        <input type="number" step="0.01" name="ticket_price" value="{{ $event->ticket_price }}">
    </div>

    <div>
        <label>Total Tickets</label>
        <input type="number" name="total_tickets" value="{{ $event->total_tickets }}">
    </div>

    <div>
        <label>Event Image</label>
        <input type="file" name="image">
    </div>

    <button type="submit">
        Update Event
    </button>
</form>