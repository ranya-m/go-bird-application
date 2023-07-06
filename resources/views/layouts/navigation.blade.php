<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        {{-- <div class="flex justify-between h-16"> --}}

    {{-- *** --}}
        <div class="flex h-16">
                <!-- Logo -->
                <div class="shrink-0 flex items-center float-left ">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>   
                </div>

                <!-- Navigation Links -->
               <div class="hidden 2xl:space-x-20 space-x-4 lg:space-x-8 sm:-my-px sm:ml-10 sm:flex w-screen justify-center">
                @if(request()->routeIs('become.host'))
                    <x-nav-link href="{{ route('home') }}" class="nav-link">
                        Save and Quit
                    </x-nav-link>
                @else
                    
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Explore Offers') }}
                </x-nav-link>

                @guest
                <x-nav-link :href="route('register')">
                    {{ __('Join the community') }}
                </x-nav-link>

                @php
                $registerHostUrl = route('register', ['redirectToBecomeHost' => true]);
                @endphp

                <x-nav-link :href="$registerHostUrl">
                    {{ __('List your property') }}
                </x-nav-link>
                
                    @else
                        @if(!Auth::user()->isHost())   
                            <x-nav-link :href="route('traveler.dashboard')" :active="request()->routeIs('traveler.dashboard')">
                                {{ __('My Traveler Dashboard') }}
                            </x-nav-link> 
                            <x-nav-link :href="route('become.host')" :active="request()->routeIs('become.host')">
                                {{ __('Become a host') }}
                            </x-nav-link> 
                        @else
                            
                                    
                                <x-nav-link :href="route('traveler.dashboard')" :active="request()->routeIs('traveler.dashboard')">
                                    {{ __('My Traveler Dashboard') }}
                                </x-nav-link> 
                                <x-nav-link :href="route('host.dashboard')" :active="request()->routeIs('host.dashboard')">
                                    {{ __('My Host Dashboard') }}
                                </x-nav-link>
                        @endif 
                    @endguest
                @endif                        
               </div>

               <!-- Settings Dropdown -->
               <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm 2xl:text-base  leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="text-sm 2xl:text-base ">
                                @auth
                                {{ Auth::user()->name }}
                                @else
                                {{__('Account')}}
                                @endauth
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('messages.index')">
                                {{ __('Messages') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                            @else
                                @if (Route::has('register'))
                                    <x-dropdown-link :href="route('register')">
                                        {{ __('Register') }}
                                    </x-dropdown-link>
                                @endif
                                @if (Route::has('login'))
                                    <x-dropdown-link :href="route('login')">
                                    {{ __('Login') }}
                                    </x-dropdown-link>
                                @endif
                        @endauth
                        
                    </x-slot>
                </x-dropdown>
               </div>
               <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden w-screen justify-end">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
        </div>

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(request()->routeIs('become.host'))
            <x-responsive-nav-link href="{{ route('home') }}" class="nav-link">
                Save and Quit
            </x-responsive-nav-link>
        @else
            
        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Explore Offers') }}
        </x-responsive-nav-link>

        @guest
        <x-responsive-nav-link :href="route('register')">
            {{ __('Join the community') }}
        </x-responsive-nav-link>

        @php
        $registerHostUrl = route('register', ['redirectToBecomeHost' => true]);
        @endphp

        <x-responsive-nav-link :href="$registerHostUrl">
            {{ __('List your property') }}
        </x-responsive-nav-link>
        
            @else
                @if(!Auth::user()->isHost())   
                    <x-responsive-nav-link :href="route('traveler.dashboard')" :active="request()->routeIs('traveler.dashboard')">
                        {{ __('My Traveler Dashboard') }}
                    </x-responsive-nav-link> 
                    <x-responsive-nav-link :href="route('become.host')" :active="request()->routeIs('become.host')">
                        {{ __('Become a host') }}
                    </x-responsive-nav-link> 
                @else
                    
                            
                        <x-responsive-nav-link :href="route('traveler.dashboard')" :active="request()->routeIs('traveler.dashboard')">
                            {{ __('My Traveler Dashboard') }}
                        </x-responsive-nav-link> 
                        <x-responsive-nav-link :href="route('host.dashboard')" :active="request()->routeIs('host.dashboard')">
                            {{ __('My Host Dashboard') }}
                        </x-responsive-nav-link>
                @endif 
            @endguest
        @endif  
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                <div class="font-medium text-sm 2xl:text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm 2xl:text-base text-gray-500">{{ Auth::user()->email }}</div>
                @else
                {{__('Account')}}
                @endauth
            </div>

            <div class="mt-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('messages.index')">
                                {{ __('Messages') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @else
                    @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    @endif
                    @if (Route::has('login'))
                    <x-responsive-nav-link :href="route('login')">
                    {{ __('Login') }}
                    </x-responsive-nav-link>
                    @endif
            @endauth
            

            </div>
        </div>
    </div>
</nav>


