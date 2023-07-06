<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Traveler Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8">
                        @foreach ($listings as $listing) 
                        <a>
                            <div class="mx-5 mt-5">
                                <img src="https://images.unsplash.com/photo-1544984243-ec57ea16fe25?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80" alt="Offer Photos" alt="Offer Photos" class="rounded-lg bg-cover max-h-48">
                                <div class="flex flex-row justify-between items-start mt-4">
                                    <div>
                                        <p class="text-sm text-gray-800 font-bold">{{ $listing->city }}, {{ $listing->country }}</p>
                                        <p class="text-sm text-gray-800">{{ $listing->title }}</p>
                                        <p class="text-sm text-gray-800">Aug 18-25</p>
                                        <p class="text-sm text-gray-800 mt-2"> <strong>{{ $listing->price }}</strong> per night</p>
                                    </div>
                                    <div class="flex flex-row items-center">
                                        <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <p class="text-sm">rating</p>
                                        {{-- <p class="text-sm">{{ $listing->rating }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        </a> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
