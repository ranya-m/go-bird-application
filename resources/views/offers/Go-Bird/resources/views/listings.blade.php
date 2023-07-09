{{-- <x-guest-layout> --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
    @foreach ($listings as $listing) 
    <a>
        <div class="mx-5 mt-5">
            <img src="{{ $offer->photos[0] }}" alt="Offer Photos" class="rounded-lg bg-cover">
            <div class="flex flex-row justify-between items-start mt-4">
                <div>
                    <p class="text-sm text-neutral-800 font-bold">{{ $offer->city }}, {{ $offer->country }}</p>
                    <p class="text-sm text-neutral-800">{{ $offer->title }}</p>
                    <p class="text-sm text-neutral-800">Aug 18-25</p>
                    <p class="text-sm text-neutral-800 mt-2"> <strong>{{ $offer->price }}</strong> per night</p>
                </div>
                <div class="flex flex-row items-center">
                    <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <p class="text-sm">rating</p>
                    {{-- <p class="text-sm">{{ $offer->rating }}</p> --}}
                </div>
            </div>
        </div>
    </a> 
    @endforeach
</div>
{{-- </x-guest-layout> --}}

{{-- <div class="offer-card">
    <div class="offer-image">
      <img src="{{ $offer->photos[0] }}" alt="Offer Photo">
    </div>
    <div class="offer-details">
      <h2 class="offer-title">{{ $offer->title }}</h2>
      <p class="offer-country">{{ $offer->country }}</p>
      <p class="offer-city">{{ $offer->city }}</p>
      <p class="offer-price">{{ $offer->price }}</p>
      <div class="offer-rating">
        @for ($i = 1; $i <= $offer->rating; $i++)
        <span class="star"></span>
        @endfor
      </div>
    </div>
  </div> --}}

{{-- <a href="https://laravel.com/docs" class="scale-100 p-6 bg-white dark:bg-neutral-800/50 dark:bg-gradient-to-bl from-neutral-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-neutral-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div>
        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
        </div>

        <h2 class="mt-6 text-xl font-semibold text-neutral-900 dark:text-white">Documentation</h2>

        <p class="mt-4 text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
            Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
        </p>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
    </svg>
</a> --}}