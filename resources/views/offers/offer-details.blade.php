<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-lg 2xl:text-xl text-neutral-800 leading-tight">
            {{ __('Offer details') }}
        </h2>
    </x-slot> --}}

    <div class="mt-5 mx-10">

            <div class="w-full mb-2">

                <p class="text-xl 2xl:text-2xl font-semibold text-neutral-800">{{ $offer->title }}</p>
                <div class="flex flex-nowrap items-center">
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
                <div class="md:grid md:grid-cols-2 md:gap-4">
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
                

                
                <div class="grid grid-cols-1 md:grid-cols-2 my-2">
                    <div>
                        

                        <p class=" text-neutral-800 font-bold">About the property</p>

                        <p class="2xl:text-base text-sm text-neutral-800 text-justify leading-relaxed">{{ $offer->description }}
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, aperiam dolorem! Nam esse sapiente veniam in beatae sed soluta incidunt, excepturi, amet numquam tempora molestiae adipisci omnis, deserunt autem cum! Voluptatem, ea pariatur voluptate odit consequatur nulla inventore. At nulla, officiis laborum quam quaerat culpa accusantium, accusamus aperiam ducimus sed reprehenderit voluptas cum, ut vitae nam necessitatibus ipsum saepe illum tenetur impedit eaque nobis similique. <br> Sint inventore consequatur aut saepe, ea dolore asperiores debitis suscipit unde itaque culpa ad, mollitia dolores vel eligendi enim alias iure error modi, pariatur laudantium voluptate? Distinctio minus, molestias reprehenderit nulla perspiciatis culpa harum repellendus voluptates perferendis animi tempora iste, id cupiditate a qui facere tempore illo nobis eos placeat repudiandae atque delectus aliquam architecto! Itaque iusto inventore reiciendis quibusdam aperiam veritatis at veniam soluta cupiditate doloribus exercitationem ut similique quaerat animi repudiandae neque distinctio repellat quia, possimus quam quidem praesentium, porro fugit saepe. <br> Quia reiciendis expedita, iste ipsum odio tempora, qui libero natus nam, repellendus labore iusto atque odit! Voluptatibus culpa at quasi saepe. Commodi adipisci aspernatur magnam similique consectetur recusandae aperiam doloremque veniam iusto nemo, animi minus velit eos odit fugiat dolores molestiae dolorem. Tenetur assumenda, consequuntur sunt similique itaque numquam laboriosam magnam?</p>
                        
                        <p class="  text-neutral-800 font-bold">About the host
                        </p>
                        @if(isset($user))
                        <a class="cursor-pointer" href="{{ route('public-profile.show', $user) }}"> 
                            @if($user->profile_pic) {
                            <img src="{{ $offer->host->user->profile_pic }}" alt="Profile Photo"> 
                            }@else
                            <img class="w-36" src="https://icon-library.com/images/android-profile-icon/android-profile-icon-26.jpg" alt="Profile Photo">
                            @endif
                            <p class="text-neutral-800 font-bold">Hosted by{{ $offer->host->user->name }}</p>

                        </a>
                        @endif
                        
                        <x-secondary-button>
                            <a href="{{ route('messages.index', $offer->host->user) }}">
                                Contact
                            </a>
                        </x-secondary-button>

                    </div>

                    <div>
                        <p class="text-sm text-neutral-800 mt-2"> <strong>{{ $offer->price }}</strong> per night</p>

                        <div class="text-xs 2xl:text-base grid grid-cols-1 xs:grid-cols-2  ">
                            
                            <label
                            for="start_date"
                            class="block overflow-hidden border  border-transparent xs:border-y-transparent xs:border-x-neutral-200  focus:border-transparent pt-1 "
                            >
                            <span class="text-xs font-medium text-neutral-500 "> Start Date </span>
                            <input
                            x-model="startDate" @change="calculateTotalPrice"
                            type="date"
                            name="start_date"
                            id="start_date"
                            value="{{ request()->input('start_date') }}" 
                            placeholder=""
                            class="mx-auto text-center place-items-center  border border-transparent focus:border-transparent relative m-0 block  min-w-0 flex-auto bg-transparent  font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-xs 2xl:text-base  "
                            />
                            </label>
                            <label
                            for="end_date"
                            class="block overflow-hidden xs:rounded-md border border-x-transparent border-y-neutral-200 xs:border-transparent focus:border-transparent pt-1 "
                            >
                            <span class="text-xs font-medium text-neutral-500"> End Date </span>
                            <input
                            x-model="endDate" @change="calculateTotalPrice"
                            type="date"
                            name="end_date"
                            id="end_date"
                            value="{{ request()->input('end_date') }}" 
                            placeholder=""
                            class="mx-auto text-center place-items-center  border border-transparent focus:border-transparent relative m-0 block min-w-0 flex-auto bg-transparent font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-xs 2xl:text-base"
                            />
                            </label>
                                                      
                        </div>


                        <x-primary-button>
                        <a href="{{ route('reservations.create', ['offerId' => $offer->id]) }}">
                            Reserve
                        </a>
                        </x-primary-button>
                        <p>You won't be charged yet</p>
                    </div>
                </div>

                
            </div>       
    </div>

</x-app-layout>