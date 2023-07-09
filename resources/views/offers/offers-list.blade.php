@if ($offers->isEmpty())
    <p class="text-sm 2xl:text-base text-center pt-10">Oops ! No offers available for your search criteria.</p>
    <p class="text-center mt-2"><a href="{{ route('offers.search') }}" class="hover:bg-cyan-500 rounded-lg py-1 px-2 text-sm text-neutral-50  bg-neutral-400 ">Explore other offers</a></p>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 2xl:gap-4 ">

    @foreach ($offers as $offer) 
    <div class="offer-card">
        <a>
            <div class="mt-5">
                <a href="{{ route('offers.detail', ['offerId' => $offer->id]) }}">
                    <div class="relative h-52 2xl:h-60 rounded-lg overflow-hidden">
                    <img src="{{ $offer->photos[0] }}" alt="Offer Photos" class=" bg-cover object-cover w-full h-full">
                    <p class=" text-neutral-800 text-sm 2xl:text-base absolute bottom-1.5 right-0 bg-neutral-50 rounded-l-lg py-0 px-2 opacity-90"> <strong>{{ $offer->price }}</strong> per night</p>
                    </div>
                    {{-- <img src={{ asset('storage/photos/photo.jpeg') }} alt="Offer Photos" class="rounded-lg bg-cover object-cover w-full h-48 2xl:h-60"> --}}
                    <div class="relative flex flex-row justify-between items-start mt-4">
                        <div class="text-sm 2xl:text-base">
                            <p class=" text-neutral-800 font-bold">{{ $offer->city }}, {{ $offer->country }}</p>
                            <p class="text-neutral-600">{{ $offer->title }}</p>
                            {{-- <p>Hosted by {{ $offer->host->user->name }}</p> --}}

                        </div>
                        @if ($offer->rating)
                        <div class="flex flex-row items-center">
                            <svg class="w-6 h-6 2xl:w-8 2xl:h-8 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="text-sm 2xl:text-base">{{ $offer->rating }}</p>
                        </div>
                        @endif
                    </div>
                </a>
            </div>
        </a> 
    </div>
    @endforeach
@endif
</div>

{{ $offers->appends(request()->except('page'))->links() }}
