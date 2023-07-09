<x-app-layout>
    <x-slot name="header">
        @include('offers.offers-search') 
    </x-slot>

    <div class="">
        <div class="bg-white w-full mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden relative">
                <div class='w-full flex justify-end pt-4 pr-4'>
                @include('offers.offers-sort')
                </div>

                <div class="px-6 pt-3 pb-10 text-neutral-900">
                    @include('offers.offers-list', ['offers' => $offers])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
