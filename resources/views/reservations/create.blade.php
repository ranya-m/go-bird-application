<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-500 leading-tight">
            {{ __('Reservation informations') }}
        </h2>
    </x-slot>

<div class="items-center justify-center p-12">
        <div class="mx-auto w-full bg-white grid grid-cols-1 md:grid-cols-2">
            {{-- Guest Informations Form --}}
            <form class="order-last md:order-first" action="{{ route('reservations.store', ['offerId' => $offer->id])}}" method="POST">
                @csrf
                <input type="hidden" name="offer_id" value="{{ request('offerId') }}">

                <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                    <label
                        for="fName"
                        class="mb-3 block text-base font-medium text-neutral-800"
                    >
                        First Name
                    </label>
                    <input
                        type="text"
                        name="fName"
                        id="fName"
                        placeholder="First Name"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                    <label
                        for="lName"
                        class="mb-3 block text-base font-medium text-neutral-800"
                    >
                        Last Name
                    </label>
                    <input
                        type="text"
                        name="lName"
                        id="lName"
                        placeholder="Last Name"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                    </div>
                </div>
                </div>
                <div class="mb-5">
                <label
                    for="guest"
                    class="mb-3 block text-base font-medium text-neutral-800"
                >
                    Total number of guests
                </label>
                <input
                    type="number"
                    name="guest"
                    id="guest"
                    placeholder="4"
                    min="1"
                    class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
                </div>
        
                <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                    <label
                        for="start_date"
                        class="mb-3 block text-base font-medium text-neutral-800"
                    >
                        Date of arrival
                    </label>
                    <input
                        type="date"
                        name="start_date" value="{{ request()->input('start_date') ?? $startDate }}" id="start_date" data-unavailable-dates="{{ $encUnavailableDates }}"  required
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                    <label
                        for="end_date"
                        class="mb-3 block text-base font-medium text-neutral-800"
                    >
                        Date of departure
                    </label>
                    <input
                        type="date"
                        name="end_date"  value="{{ request()->input('end_date') ?? $endDate }}" id="end_date" data-unavailable-dates="{{ $encUnavailableDates }}" required
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                    </div>
                </div>

                </div>
        

        
                <div>
                <x-primary-button type='submit'
                    class="mt-4 py-3 px-8  "
                >
                    Request To Book
                </x-primary-button>
                </div>
          </form>

           {{-- Total price summary --}}
           <div class="md:mt-4 mb-12 md:mx-auto w-full xs:w-4/5 h-fit px-3 py-6 border-2 border-cyan-500 border-opacity-40 rounded-xl">
            <div class="xs:flex md:flex-none lg:flex mb-4">
                <div class="w-44 md:mr-2 flex-wrap items-center">
                    <img class=" bg-cover object-cover rounded-lg" src="{{ $offer->photos[0] }}" alt="">
                </div>
                <div class="w-full">
                    <p class="ml-2 font-semibold text-neutral-800 my-2">{{ $offer->title }}</p>
                    <div class="flex flex-nowrap items-center mb-6">
                        {{-- @if ($offer->rating)
                        <div class="flex flex-row items-center mr-2">
                            <svg class="w-6 h-6 2xl:w-8 2xl:h-8 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="text-sm">{{ $offer->rating }}</p>
                            @endif
                        </div> --}}
                        <div class="flex flex-row items-center">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABt0lEQVR4nO2Wuy8EURjFf0sQr9omim1EVJ4tGpHsIqIQ/wLBX4DKq6dD9Kj8BWQlEiIKFLYSQTwKbyph5MaRTOzYnZ2ZXZHsSb5kcr9zzvfdO3fuHcjjH6ITWAISwIviGFgEOrJZuBaIA1aa2ARqgi7eDtypwDUwBjQA5YpGYFw5w7kFWoOc+Z2MV4CKFNxKYNXWRCArEbcVD7ngG86aNBtBbDhLS5tq5k4rcSOtr425JBPzzjPFhLQLfhpIyKTeIdcNXADnQMwh3yit+UQ940kmTst/bvv0zn55DZY8PONFJlUeGggr9+yngX2ZOC1xTE2Y4lGHfJe0e34amJHJsgftsrTTfg+hD+ARKMtAVwo8qIE6fGJLRsMZaEakMVrf6LNttGIX/CLgVJreIBoIAYcyHHTBHxL3wOXR7QoDMr1McySb3JW4/QSIELAt48kUvClxdoOc/TfaZP4KREhGRDkryH+Bn/i+69eTMl9jljhZQxi4V6Ee23hUY+a8qCbLGFWxE9sv2YnGTC7rKAB2VHAOmLed+YXkCC3AG/CuMM/N5BiztuvY14XjFSXAkcI8/wmaFHngFZ8Iv4WumFnlpQAAAABJRU5ErkJggg==" class="w-6 h-5 2xl:w-8 2xl:h-7">
                            <p class="text-sm text-neutral-900 font-semibold">{{ $offer->city }}, {{ $offer->country }}</p>
                        </div>
                    </div>
                </div>               
            </div>

            <div class="mb-3 block text-base font-semibold text-neutral-800">
              Total price to pay: 
                           
              @if(request()->input('start_date') && request()->input('end_date'))
                <div class="mt-4"  x-show="startDate && endDate">
                    <p class="flex justify-between">
                    <span class="font-semibold underline">${{$offer->price}} x {{ $numberOfNights }} @if($numberOfNights == 1) night: @else nights: @endif </span> 
                    <span>${{ $totalPrice }}</span>
                    </p>
                </div> 
             <p class="text-sm text-gray-400 mt-4">You will receive an invitation to pay once the host accepts your request.</p>                        
              @endif
            </div>      
        </div>
        </div>
      </div>


</x-app-layout>