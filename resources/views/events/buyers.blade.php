<x-app-layout>
    <x-slot name="header">
        <h2>Buyers for {{ $event->title }}</h2>
    </x-slot>

    <div class="p-6">

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

    </div>
</x-app-layout>