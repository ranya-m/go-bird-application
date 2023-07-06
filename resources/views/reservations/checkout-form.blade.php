<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Confirm Stay') }}
        </h2>
    </x-slot>

    <div class="leading-loose">
        <form class="max-w-2xl m-4 p-10 bg-white rounded shadow-2xl" method="POST" action="{{ route('reservation.confirm', ['reservationId' => $reservation->id]) }}">
            @csrf

            <p class="text-gray-800 font-medium">Customer information</p>
            <div class="">
                <label class="block text-sm text-gray-600" for="customer_name">Name</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="customer_name" name="customer_name" type="text" placeholder="Your Name" aria-label="Name" required>
            </div>
            <!-- Rest of the form fields -->

            <p class="mt-4 text-gray-800 font-medium">Payment information</p>
            <div class="">
                <label class="block text-sm text-gray-600" for="card_number">Card</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="card_number" name="card_number" type="text" placeholder="Card Number MM/YY CVC" aria-label="Name" required>
            </div>
            <div class="mt-4">
                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Confirm and Pay</button>
            </div>
        </form>
    </div>
</x-app-layout>
