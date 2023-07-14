<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight">
            {{ __('Reservation informations') }}
        </h2>
    </x-slot>

<form action="{{ route('reservations.store', ['offerId' => $offer->id])}}" method="POST">
    @csrf

    <input type="hidden" name="offer_id" value="{{ request('offerId') }}">


        <label for="start_date">Start Date:</label>
        <input type="text" name="start_date" value="{{ request()->input('start_date') ?? $startDate }}" id="start_date" data-unavailable-dates="{{ $encUnavailableDates }}" required>

        <label for="end_date">End Date:</label>
        <input type="text" name="end_date" value="{{ request()->input('end_date') ?? $endDate }}" id="end_date" data-unavailable-dates="{{ $encUnavailableDates }}" required>

        
        {{-- Summary of total price depending on number of nights--}}
        @if(request()->input('start_date') && request()->input('end_date'))
            <div class="mt-4"  x-show="startDate && endDate">
                <p>Total price</p>
                <p class="flex justify-between">
                <span class="font-semibold underline">${{$offer->price}} x {{ $numberOfNights }} nights</span> 
                <span>${{ $totalPrice }}</span>
                </p>
            </div>                        
        @endif 

        
    <x-primary-button type='submit'>
        Request to book
    </x-primary-button>
    <p class="text-sm text-gray-400">You will receive an invitation to pay once the host accepts your request</p>

</form>
</x-app-layout>