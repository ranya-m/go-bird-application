<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Offer details') }}
        </h2>
    </x-slot>

    <div class="mt-5 mx-10">

            <div class="w-full ">
                
                <div class="grid grid-cols-2 gap-4 w-full h-[350px]">
                    <div class='w-full h-[350px]'>
                        <img class="h-[350px] w-full bg-cover object-cover rounded-lg" src="{{ $offer->photos[0] }}" alt="">
                    </div>
                    <div class="grid grid-cols-2 gap-2 w-full h-[170px]">
                        @foreach ($offer->photos as $index => $photo)
                        @if ($index > 0 && $index < 4)
                            <div>
                                <img class="rounded-lg bg-cover object-cover w-full h-[170px]" src="{{ $photo }}" alt="">
                            </div>
                        @endif
                        @if ($index === 4)
                            <div class="relative">
                                <img class="rounded-lg bg-cover object-cover w-full h-[170px]" src="{{ $photo }}" alt="">
                                <button id="open-photos-modal" class="absolute bottom-2 right-2 bg-gray-800 text-white px-4 py-2 rounded-lg">
                                    Show All Photos
                                </button>
                                
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>

                <!-- Show All Photos Modal -->
                <div id="photos-modal" class="photos-modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">

                    <div class="photos-modal-content bg-white p-4 rounded-lg">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <!-- Display all the photos here -->
                            @foreach ($offer->photos as $index => $photo)
                                <img src="{{ $photo }}" alt="">
                            @endforeach
                        </div>
                        <div class="text-right mt-4">
                            <button id="close-photos-modal" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 focus:outline-none">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
                

                
            </div>       
    

            <div>
                <div class="flex flex-row justify-between items-start my-2">
                    <div>
                        <p class="text-sm text-gray-800 font-bold">{{ $offer->city }}, {{ $offer->country }}</p>
                        <p class="text-sm text-gray-800">{{ $offer->title }}</p>
                        <p class="text-sm text-gray-800 mt-2"> <strong>{{ $offer->price }}</strong> per night</p>
                        @if(isset($user))
                        <a class="cursor-pointer" href="{{ route('public-profile.show', $user) }}">Hosted by {{ $offer->host->user->name }}</a>
                        @endif
                        <p class="text-sm text-gray-800">{{ $offer->description }}</p>
                    </div>
                    <div class="flex flex-row items-center">
                        <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <p class="text-sm">rating</p>
                        {{-- <p class="text-sm">{{ $offer->rating }}</p> --}}
                    </div>
                </div>

                <x-primary-button>
                <a href="{{ route('reservations.create', ['offerId' => $offer->id]) }}">
                    Reserve
                </a>
                </x-primary-button>
                <p>You won't be charged yet</p>
            </div>
    </div>

</x-app-layout>