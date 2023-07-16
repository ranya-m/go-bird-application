<x-app-layout>

    <div class="mt-5 mx-10">
            <div class="w-full mb-2">

                <p class="text-xl 2xl:text-2xl font-semibold text-neutral-800 my-2">{{ $offer->title }}</p>
                <div class="flex flex-nowrap items-center mb-6">
                    @if ($offer->rating)
                    <div class="flex flex-row items-center mr-2">
                        <svg class="w-6 h-6 2xl:w-8 2xl:h-8 text-amber-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <p class="text-sm 2xl:text-base">{{ $offer->rating }}</p>
                        @endif
                    </div>
                    <div class="flex flex-row items-center">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABt0lEQVR4nO2Wuy8EURjFf0sQr9omim1EVJ4tGpHsIqIQ/wLBX4DKq6dD9Kj8BWQlEiIKFLYSQTwKbyph5MaRTOzYnZ2ZXZHsSb5kcr9zzvfdO3fuHcjjH6ITWAISwIviGFgEOrJZuBaIA1aa2ARqgi7eDtypwDUwBjQA5YpGYFw5w7kFWoOc+Z2MV4CKFNxKYNXWRCArEbcVD7ngG86aNBtBbDhLS5tq5k4rcSOtr425JBPzzjPFhLQLfhpIyKTeIdcNXADnQMwh3yit+UQ940kmTst/bvv0zn55DZY8PONFJlUeGggr9+yngX2ZOC1xTE2Y4lGHfJe0e34amJHJsgftsrTTfg+hD+ARKMtAVwo8qIE6fGJLRsMZaEakMVrf6LNttGIX/CLgVJreIBoIAYcyHHTBHxL3wOXR7QoDMr1McySb3JW4/QSIELAt48kUvClxdoOc/TfaZP4KREhGRDkryH+Bn/i+69eTMl9jljhZQxi4V6Ee23hUY+a8qCbLGFWxE9sv2YnGTC7rKAB2VHAOmLed+YXkCC3AG/CuMM/N5BiztuvY14XjFSXAkcI8/wmaFHngFZ8Iv4WumFnlpQAAAABJRU5ErkJggg==" class="w-6 h-5 2xl:w-8 2xl:h-7">
                        <p class="text-sm 2xl:text-base text-neutral-900 font-semibold underline">{{ $offer->city }}, {{ $offer->country }}</p>
                    </div>
                    
                </div>
                
                </div>
                
                {{-- Photo gallery preview --}}
                <div class="md:grid md:grid-cols-2 md:gap-4 mb-6">
                    <div class='relative'>
                        <img class="w-full md:h-[345px] bg-cover object-cover rounded-lg" src="{{ $offer->photos[0] }}" alt="">
                        <button id="open-photos-modal" class="md:hidden absolute bottom-2 right-1 bg-neutral-50 text-neutral-800 opacity-90 px-2 py-0.5 text-sm rounded-lg font-semibold hover:bg-neutral-800 hover:text-neutral-50">
                            Show All Photos
                        </button>  
                    </div>
                    <div class="md:visible md:grid grid-cols-2 gap-2 w-full hidden ">
                        @foreach ($offer->photos as $index => $photo)
                        @if ($index > 0 && $index < 4)
                            <div>
                                <img class="rounded-lg md:bg-cover md:object-cover w-full md:h-[170px]" src="{{ $photo }}" alt="">
                            </div>
                        @endif
                        @if ($index === 4)
                            <div class="relative">
                                <img class="rounded-lg bg-cover object-cover w-full h-[170px]" src="{{ $photo }}" alt="">
                                <button id="open-photos-modal" class="absolute bottom-2 right-1 bg-neutral-50 text-neutral-800 font-semibold hover:bg-neutral-800 hover:text-neutral-50 opacity-90 px-4 py-2 rounded-lg text-sm 2xl:text-base">
                                    Show All Photos
                                </button>  
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>

                <!-- Show All Photos Modal -->
                <div id="photos-modal" class="photos-modal hidden fixed inset-0 bg-neutral-900 bg-opacity-50 flex items-center justify-center">

                    <div class="photos-modal-content bg-white p-4 rounded-lg">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <!-- Display all the photos here -->
                            @foreach ($offer->photos as $index => $photo)
                                <img src="{{ $photo }}" alt="">
                            @endforeach
                        </div>
                        <div class="text-right mt-4">
                            <button id="close-photos-modal" class="px-4 py-2 text-sm font-medium text-neutral-600 hover:text-neutral-800 focus:outline-none">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
                

                
                <div class="grid grid-cols-1 md:grid-cols-3 my-2 px-2">
                    <div class="md:mr-6 mr-0 col-span-2">
                        {{-- Briefing --}}
                        <div>                            
                            <ul class="w-full mb-6 2xl:text-base text-sm">
                                <li
                                  class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                  <p class=" text-neutral-800 font-bold text-lg">Property hosted by {{ $offer->host->user->name }}</p>
                                </li>
                                <li class="w-full py-2">
                                    <span class="font-semibold"> Type  </span> 
                                <p class="capitalize">{{ $offer->type }}</p>
                                </li>
                                <li class="w-full py-2"><span class="font-semibold"> Category  </span> 
                                <p class="capitalize">{{ $offer->category }}</p>
                                </li>
                                                              
                                <li
                                  class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2 dark:border-opacity-50">
                                  <span class="font-semibold"> Hosted since </span> 
                                  <p class="capitalize">{{ $offer->created_at }}</p></ 
                                </li>

                              </ul>
                        </div>
                        
                        {{-- About Property --}}
                        <p class=" text-neutral-800 font-bold mb-2">About the property</p>
                        <p class="2xl:text-base text-sm text-neutral-800 leading-relaxed mb-4 
                        w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                            {{ $offer->description }}
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, aperiam dolorem! Nam esse sapiente veniam in beatae sed soluta incidunt, excepturi, amet numquam tempora molestiae adipisci omnis, deserunt autem cum! Voluptatem, ea pariatur voluptate odit consequatur nulla inventore. At nulla, officiis laborum quam quaerat culpa accusantium, accusamus aperiam ducimus sed reprehenderit voluptas cum, ut vitae nam necessitatibus ipsum saepe illum tenetur impedit eaque nobis similique. <br> Sint inventore consequatur aut saepe, ea dolore asperiores debitis suscipit unde itaque culpa ad, mollitia dolores vel eligendi enim alias iure error modi, pariatur laudantium voluptate? Distinctio minus, molestias reprehenderit nulla perspiciatis culpa harum repellendus voluptates perferendis animi tempora iste, id cupiditate a qui facere tempore illo nobis eos placeat repudiandae atque delectus aliquam architecto! Itaque iusto inventore reiciendis quibusdam aperiam veritatis at veniam soluta cupiditate doloribus exercitationem ut similique quaerat animi repudiandae neque distinctio repellat quia, possimus quam quidem praesentium, porro fugit saepe. <br> Quia reiciendis expedita, iste ipsum odio tempora, qui libero natus nam, repellendus labore iusto atque odit! Voluptatibus culpa at quasi saepe. Commodi adipisci aspernatur magnam similique consectetur recusandae aperiam doloremque veniam iusto nemo, animi minus velit eos odit fugiat dolores molestiae dolorem. Tenetur assumenda, consequuntur sunt similique itaque numquam laboriosam magnam?
                        </p>
                        
                        {{-- About Host --}}
                        <p class="  text-neutral-800 font-bold mb-4">About the host
                        </p>
                        <div class="flex ml-1 mt-6 mb-10">
                            @if(isset($user))
                            <a class="cursor-pointer" href="{{ route('public-profile.show', $user) }}"> 
                                @if($user->profile_pic) {   
                                <div class="rounded-full overflow-hidden w-24">
                                    <img src="{{ $offer->host->user->profile_pic }}" alt="Profile Photo" class=""> 
                                </div>
                                }@else
                                <div class="rounded-full overflow-hidden w-24">
                                    <img class="w-full" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="Profile Photo">
                                </div>
                                @endif

                                <div class="ml-4">
                                    <p class="text-neutral-800 font-bold pb-0.5">
                                        {{ $offer->host->user->name }}
                                    </p>
                                    <p class="text-neutral-600 pb-2">
                                    Joined in {{ $offer->host->user->created_at }}
                                    </p>
                            </a>
                            @endif
                            
                                    <x-secondary-button>
                                        <a href="{{ route('messages.index', $offer->host->user) }}">
                                            Contact
                                        </a>
                                    </x-secondary-button>
                                </div>
                        </div>
                    </div>
                     
                    {{-- reservation preview card--}}
                    <div class="mx-0 mb-10 lg:mx-10 px-6 py-10 bg-white shadow-xl rounded-2xl dark:bg-gray-800 h-fit">

                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            ${{$offer->price}}
                            <span class="text-sm text-gray-300">
                                / night
                            </span>
                        </p>
                        <p class="mt-4 text-xs text-gray-600 dark:text-gray-100">
                            <form action="{{ route('reservations.create', ['offerId' => $offer->id, 'startDate' => request()->input('start_date') ?? $startDate, 'endDate' => request()->input('end_date') ?? $endDate]) }}" method="GET">
                                @csrf

                            <div class="text-xs 2xl:text-base " x-data="{ startDate: '', endDate: '', numberOfNights: 0, totalPrice: 0 }">   
                                <label
                                for="start_date"
                                class="block overflow-hidden focus:border-transparent outline-none pt-1 mt-6"
                                >
                                <span class="text-xs font-medium text-neutral-500 "> Start Date </span>
                                <input
                                x-model="startDate" 
                                x-on:change="calculateTotalPrice()" 
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ request()->input('start_date') }}" 
                                class="w-full mx-auto text-center place-items-center  border border-x-transparent border-t-transparent border-b-neutral-200 focus:border-transparent relative m-0 block min-w-0 flex-auto bg-transparent font-normal leading-[1.6] text-neutral-500 outline-none focus:outline-none focus:ring-0 text-xs 2xl:text-base"
                                />
                                </label>
                                <label
                                for="end_date"
                                class="block overflow-hidden rounded-md focus:border-transparent pt-1 "
                                >
                                <span class="text-xs font-medium text-neutral-500"> End Date </span>
                                <input
                                x-model="endDate"
                                x-on:change="calculateTotalPrice()" 
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ request()->input('end_date') }}" 
                                placeholder=""
                                class="w-full mx-auto text-center place-items-center  border border-x-transparent border-t-transparent border-b-neutral-200 focus:border-transparent relative m-0 block min-w-0 flex-auto bg-transparent font-normal leading-[1.6] text-neutral-500 outline-none focus:outline-none focus:ring-0 text-xs 2xl:text-base"
                                />
                                </label>                                                 
                            </div>                
                        </p>

                            <div class="text-center mt-8">
                                <x-primary-button type="submit" class="mb-2">
                                {{-- <a href="{{ route('reservations.create', ['offerId' => $offer->id]) }}"> --}}
                                    Reserve
                                {{-- </a> --}}
                                </x-primary-button>
                            </div>

                        </form>
                            
                            <p class="text-sm text-gray-300 text-center ">You won't be charged yet</p>
                    </div>

                  </div>  
            </div>                
    </div>       
    </div>
</x-app-layout>