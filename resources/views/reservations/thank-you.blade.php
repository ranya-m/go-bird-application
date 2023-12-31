<!-- reservations/thank-you.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-neutral-800 leading-tight">
            {{ __('Thank You') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-neutral-200">
                    <h1 class="text-3xl font-bold mb-4">Thank You for Your Reservation!</h1>
                    <p>Your reservation has been confirmed. We look forward to hosting you. If you have any further questions or need assistance, please don't hesitate to contact us.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
