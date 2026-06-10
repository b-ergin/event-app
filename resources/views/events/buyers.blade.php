<x-app-layout>
    <x-slot name="header">
        <h2>Buyers for {{ $event->title }}</h2>
    </x-slot>

    <div class="p-6">

        @if ($tickets->isEmpty())
            <p>No tickets have been sold for this event yet.</p>
        @else

            @foreach ($tickets as $ticket)

                <p>
                    {{ $ticket->user->email }}
                    —
                    Quantity: {{ $ticket->quantity }}

                    <a href="/events/{{ $event->id }}/buyers/{{ $ticket->id }}">
                        View
                    </a>
                </p>

                <hr>

            @endforeach

        @endif

    </div>
</x-app-layout>