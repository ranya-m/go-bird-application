<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight">
            {{ __('My confirmed stays') }}
        </h2>
</x-slot>

<h2>Confirmed Stays</h2>
@if ($confirmedStays->isEmpty())
    <p>No confirmed stays yet.</p>
@else
    <ul>
        @foreach ($confirmedStays as $reservation)
            <div class="reservation-card p-4">
                <a class="cursor-pointer" href="{{ route('public-profile.show', $reservation->offer->host->user->id) }}">Hosted by {{ $reservation->offer->host->user->name }}</a>


                <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">
                    <img src="{{ $reservation->offer->photos[0] }}" alt="Offer Photos" class="rounded-lg bg-cover object-cover w-48 h-48">
                    <li>{{ $reservation->offer->title }}</li>
                    <p>Start Date: {{ $reservation->start_date }}</p>
                    <p>End Date: {{ $reservation->end_date }}</p>
                </a>
            </div>
        @endforeach
    </ul>
@endif

</x-app-layout>