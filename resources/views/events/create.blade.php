<h1>Create Event</h1>

@if ($errors->any())
    <div>
        <h2>Please fix the following errors:</h2>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/events" enctype="multipart/form-data">
    @csrf

    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title') }}">
    </div>

    <div>
        <label>Category</label>

        <select name="category_id">
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @if (old('category_id') == $category->id)
                        selected
                    @endif
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Description</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label>Venue</label>
        <input type="text" name="venue" value="{{ old('venue') }}">
    </div>

    <div>
        <label>Event Date</label>
        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}">
    </div>

    <div>
        <label>Ticket Price</label>
        <input type="number" step="0.01" name="ticket_price" value="{{ old('ticket_price') }}">
    </div>

    <div>
        <label>Total Tickets</label>
        <input type="number" name="total_tickets" value="{{ old('total_tickets') }}">
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

    <button type="submit" name="status" value="draft">
        Save Draft
    </button>

    <button type="submit" name="status" value="published">
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