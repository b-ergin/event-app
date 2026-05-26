<h1>Create Event</h1>

<form method="POST" action="/events">
    @csrf

    <div>
        <label>Title</label>
        <input type="text" name="title">
    </div>

    <div>
        <label>Description</label>
        <textarea name="description"></textarea>
    </div>

    <div>
        <label>Venue</label>
        <input type="text" name="venue">
    </div>

    <div>
        <label>Event Date</label>
        <input type="datetime-local" name="event_date">
    </div>

    <div>
        <label>Ticket Price</label>
        <input type="number" step="0.01" name="ticket_price">
    </div>

    <div>
        <label>Total Tickets</label>
        <input type="number" name="total_tickets">
    </div>

    <button type="submit">
        Create Event
    </button>
</form>