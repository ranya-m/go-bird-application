<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight">
            {{ __('My Traveler Dashboard') }}
        </h2>
    </x-slot>

    <div class="mx-5 mt-5  bg-white shadow sm:rounded-lg">
        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight p-4">My Reservations Requests</h2>
        <x-primary-button>
            <a href="{{ route('traveler.reservations-requests') }}">Check Reservations Requests</a>
        </x-primary-button>

        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight p-4">My Confirmed Stays</h2>
        <x-primary-button>
            <a href="{{ route('traveler.confirmed-stays') }}">Check Confirmed Stays</a>
        </x-primary-button>

        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight p-4">My Past Stays</h2>
        <x-primary-button>
            <a href="{{ route('traveler.past-stays') }}">Check Past Stays</a>
        </x-primary-button>
    </div>

</x-app-layout>