<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My past stays') }}
        </h2>
    </x-slot>

    <h2>Past Stays</h2>
    @if ($pastStays->isEmpty())
        <p>No past stays yet.</p>
    @else
        <ul>
            @foreach ($pastStays as $reservation)
            <div class="reservation-card p-4">
                <a class="cursor-pointer" href="{{ route('public-profile.show', $reservation->offer->host->user->id) }}">Hosted by {{ $reservation->offer->host->user->name }}</a>


                <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">
                    <img src="{{ $reservation->offer->photos[0] }}" alt="Offer Photos" class="rounded-lg bg-cover object-cover w-48 h-48">
                    <li>{{ $reservation->offer->title }}</li>
                    <x-secondary-button>
                        <a href="{{ route('reservations.create', ['offerId' => $reservation->offer->id]) }}" class="btn btn-primary">Request to Book Again</a>
                    </x-secondary-button>
                </a>
            </div>            @endforeach
        </ul>
    @endif

</x-app-layout>