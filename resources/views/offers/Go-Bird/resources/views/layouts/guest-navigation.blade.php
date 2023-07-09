<div>
    <div class="relative px-6 py-4 h-16 sm:flex justify-between sm:items-center bg-dots-darker bg-center bg-neutral-100 dark:bg-dots-lighter dark:bg-neutral-900 selection:bg-red-500 selection:text-white">
    <x-application-logo />
    <div> 
        @if (Route::has('login'))
            <div class="">
            @auth
                    <a href="{{ url('/travelerboard') }}" class="font-semibold text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Traveler board</a>
                    
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth   
            </div>
        @endif
        </div>
    </div>
</div>

    


