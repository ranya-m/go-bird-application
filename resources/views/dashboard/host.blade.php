<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Host Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <x-primary-button onclick="window.location.href = '{{ route('profile.edit') }}#identity-verification';">{{ __('Click here to verify identity') }}</x-primary-button>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <x-primary-button onclick="window.location.href = '{{ route('profile.edit') }}#phone-verification';">
                        {{ __('Click here to verify phone number') }}
                    </x-primary-button>
                </div>
            </div> --}}

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">All Reservations</h2>

            <h2>Pending Reservations Requests</h2>
            <x-primary-button>
                <a href="{{ route('host.reservations.pending') }}">Check Pending Reservations Requests</a>
            </x-primary-button>


            <h2>Accepted Reservations</h2>
            <x-primary-button>
                <a href="{{ route('host.ongoing.accepted.reservations') }}">Check Ongoing Accepted Stays</a>
            </x-primary-button>
            <x-primary-button>
                <a href="{{ route('host.future.accepted.stays') }}">Check Future Accepted Stays</a>
            </x-primary-button>

            <h2>All Reservations Requests History</h2>
            <x-primary-button>
                <a href="{{ route('host.reservations.history') }}">Check Reservations History</a>
            </x-primary-button>
            </div>
        </div>
       
    </div>

</x-app-layout>

{{-- @foreach ($reservations as $reservation)
<div class="p-2">
    <p>Requested by: {{ $reservation->user->name }}</p>
    <a href="{{ route('public_profile', ['userId' => $reservation->user->id]) }}"></a>
    <p>Offer: <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">{{ $reservation->offer->title }}</a></p>
    <p>Dates: {{ $reservation->start_date }} to {{ $reservation->end_date }}</p>
    <form action="{{ route('host.reservations.accept', ['reservationId' => $reservation->id]) }}" method="POST" class="inline-block">
        @csrf
        <x-secondary-button type="submit">Accept</x-secondary-button>
    </form>
    <form action="{{ route('host.reservations.decline', ['reservationId' => $reservation->id]) }}" method="POST" class="inline-block">
        @csrf
        <x-secondary-button type="submit">Decline</x-secondary-button>
    </form>
</div>
@endforeach --}}

{{-- @foreach ($recentReservations as $reservation)
<div class="p-2">
    <p>Requested by:{{ $reservation->user->name }}</p>
    <a href="{{ route('public_profile', ['userId' => $reservation->user->id]) }}"></a>
    <p>Offer: <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">{{ $reservation->offer->title }}</a></p>
    <p>Dates: {{ $reservation->start_date }} to {{ $reservation->end_date }}</p>
    <form action="{{ route('host.reservations.accept', ['reservationId' => $reservation->id]) }}" method="POST" class="inline-block">
        @csrf
        <x-secondary-button type="submit">Accept</x-secondary-button>
    </form>
    <form action="{{ route('host.reservations.decline', ['reservationId' => $reservation->id]) }}" method="POST" class="inline-block">
        @csrf
        <x-secondary-button type="submit">Decline</x-secondary-button>
    </form>
</div>
@endforeach --}}