<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Ongoing Accepted Stays') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">Ongoing Accepted Stays</h2>
                @foreach ($ongoingAcceptedReservations as $reservation)
                <a class="cursor-pointer" href="{{ route('public-profile.show', $reservation->user->id) }}">
                    <p>Requested by: {{ $reservation->user->name }}</p>
                </a>  

                <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">

                    <div class="p-2">
                        <p>Offer: <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">{{ $reservation->offer->title }}</a></p>
                        <p>Dates: {{ $reservation->start_date }} to {{ $reservation->end_date }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
