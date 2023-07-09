<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight">
            {{ __('Reservation informations') }}
        </h2>
    </x-slot>

<form action="{{ route('reservations.store', ['offerId' => $offer->id]) }}" method="POST">
    @csrf

    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
    
            <div>
            <label for="start_date">Start Date:</label>
            <input type="text" id="start_date" name="start_date" data-unavailable-dates="{{ $encUnavailableDates }}" required>
        </div>

        <div>
            <label for="end_date">End Date:</label>
            <input type="text" id="end_date" name="end_date" data-unavailable-dates="{{ $encUnavailableDates }}" required>
        </div>
    

    <x-primary-button type='submit'>
        Request to book
    </x-primary-button>

</form>
</x-app-layout>