<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Traveler Dashboard') }}
        </h2>
    </x-slot>

    <div class="mx-5 mt-5  bg-white shadow sm:rounded-lg">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight p-4">My Reservations Requests</h2>
        @foreach ($reservations as $reservation)
        @if (!$confirmedStays->contains($reservation))
            <div class="reservation-card p-4">
                <a class="cursor-pointer" href="{{ route('public-profile.show', $reservation->offer->host->user->id) }}">Hosted by {{ $reservation->offer->host->user->name }}</a>


                <a href="{{ route('offers.detail', ['offerId' => $reservation->offer->id]) }}">

                <img src="{{ $reservation->offer->photos[0] }}" alt="Offer Photos" class="rounded-lg bg-cover object-cover w-48 h-48">
                <h3>{{ $reservation->offer->title }}</h3>
                <p>Start Date: {{ $reservation->start_date }}</p>
                <p>End Date: {{ $reservation->end_date }}</p>
                <p>Status: {{ $reservation->status }}</p>

            </a>   
   
                @if (!$reservation->isCanceledByUser())
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div>
                            <input type="hidden" name="cancel" value="1">
                            <x-secondary-button type="submit">
                                Cancel
                            </x-secondary-button>
                        </div>
                    </form>

                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('patch')
                      <div>
                        <div>
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" required>
                        </div>
                    
                        <div>
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date"  required>
                        </div>

                        {{-- data-unavailable-dates="{{ $encUnavailableDates }}" --}}

                        <x-secondary-button type="submit">Request Dates Change</x-secondary-button>
                      </div>

                    </form>
                @else
                    <div class="cancellation-message">
                        {{ $cancellationMessage }}
                    </div>
                @endif

                @if($reservationAccepted)
                <div class="alert alert-success">
                    Your reservation request has been accepted. You are invited to pay and confirm your stay.
                </div>
                <x-secondary-button>
                    <a href="{{ route('checkout.form', ['reservationId' => $reservation->id]) }}" class="btn btn-primary">Pay and Confirm</a>
                </x-secondary-button>
                @endif

            </div>
        @endif
        @endforeach
    </div>

</x-app-layout>