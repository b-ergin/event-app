<h1>Create Event</h1>

<form method="POST" action="/events" enctype="multipart/form-data">
    @csrf

    <div>
        <label>Title</label>
        <input type="text" name="title">
    </div>

    <div>
        <label>Category</label>

        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
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

    <div>
        <label>Event Image</label>
        <input type="file" name="image" id="imageInput">

        <img
            id="imagePreview"
            src=""
            alt="Selected event image preview"
            width="200"
            style="display: none;"
        >
    </div>

    <button name="status" value="draft">
        Save Draft
    </button>

    <button name="status" value="published">
        Publish
    </button>
</form>

<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        }

    });
</script>