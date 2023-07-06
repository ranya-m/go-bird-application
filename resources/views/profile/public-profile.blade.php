<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Public profile') }}
        </h2>
    </x-slot>

    <div>
        <!-- Display profile photo -->
        @if($user->profile_pic) {
            <img src="{{ $user->profile_pic }}" alt="Profile Photo">
        }@else
        <img class="w-36" src="https://icon-library.com/images/android-profile-icon/android-profile-icon-26.jpg" alt="Profile Photo">
        @endif
        <!-- Display user information -->
        <p>Name: {{ $user->name }}</p>
        <p>GoBird member since: {{ $user->created_at }}</p>
        <p>Identity Status: {{ $user->hasVerifiedIdentity() ? 'Verified' : 'Not Verified' }}</p>
        <p>About Me: {{ $user->about_me }}</p>

                <!-- Contact button -->
                <a href="{{ route('messages.index', ['user' => $user->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Contact
                </a>
    

       <!-- Display offers hosted by the user if they are a host -->
@if (count($offers) > 0)
<h2>Offers Hosted by {{ $user->name }}</h2>
<ul>
    @foreach ($offers as $offer)
        <li>
            <a href="{{ route('offers.detail', ['offerId' => $offer->id]) }}">
                <img src="{{ $offer->photos[0] }}" alt="Offer Photos" class="rounded-lg bg-cover object-cover w-full h-48">
                <div class="flex flex-row justify-between items-start mt-4">
                    <div>
                        <p class="text-sm text-gray-800 font-bold">{{ $offer->city }}, {{ $offer->country }}</p>
                        <p class="text-sm text-gray-800">{{ $offer->title }}</p>
                        <p class="text-sm text-gray-800">Aug 18-25</p>
                        <p class="text-sm text-gray-800 mt-2"> <strong>{{ $offer->price }}</strong> per night</p>
                        <p>Hosted by {{ $offer->host->user->name }}</p>
                    </div>
                    @if ($offer->rating)
                        <div class="flex flex-row items-center">
                            <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="text-sm">{{ $offer->rating }}</p>
                        </div>
                    @endif
                </div>
            </a>
        </li>
    @endforeach
</ul>
@endif
</div>

</x-app-layout>
