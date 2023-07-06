    <form action="{{ route('offers.search') }}" method="GET" class="">
        <div class="mx-auto text-center w-fit rounded-2xl border border-solid border-neutral-200 focus:border-transparent focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none transition duration-200 ease-in-out focus:z-[3] shadow-md hover:shadow-lg">

            {{-- DESTINATION AND DATES OPTIONS --}}
            <div class="flex flex-nowrap">
            <div class="text-sm 2xl:text-base  grid grid-cols-2 sm:grid-cols-3  ">
                <label
                for="country"
                class="flex sm:block overflow-hidden border border-t-transparent border-x-transparent border-b-neutral-200 sm:border-transparent focus:border-transparent col-span-2 sm:col-span-1 pt-0 sm:pt-1"
                >
                <span class="destination text-sm font-medium text-gray-500 self-center ml-11 mr-9 sm:mx-0 "> Destination </span>
                <input
                type="text"
                name="country"
                id="country"
                value="{{ request()->input('country') }}" 
                placeholder="Anywhere"
                class="text-center mx-auto border border-transparent focus:border-transparent relative m-0 block  min-w-0 flex-auto bg-transparent  font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-sm 2xl:text-base"
                />
                </label>
                <label
                for="start_date"
                class="block overflow-hidden border  border-transparent sm:border-y-transparent sm:border-x-neutral-200  focus:border-transparent pt-1 "
                >
                <span class="text-sm font-medium text-gray-500 "> Start Date </span>
                <input
                type="date"
                name="start_date"
                id="start_date"
                value="{{ request()->input('start_date') }}" 
                placeholder=""
                class="text-center border border-transparent focus:border-transparent relative m-0 block  min-w-0 flex-auto bg-transparent  font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-sm 2xl:text-base  "
                />
                </label>
                <label
                for="end_date"
                class="block overflow-hidden rounded-md border border-transparent focus:border-transparent pt-1 "
                >
                <span class="text-sm font-medium text-gray-500"> End Date </span>
                <input
                type="date"
                name="end_date"
                id="end_date"
                value="{{ request()->input('end_date') }}" 
                placeholder=""
                class="text-center border border-transparent focus:border-transparent relative m-0 block min-w-0 flex-auto bg-transparent font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-sm 2xl:text-base"
                />
                
                </label>
                
                
            </div> 

            <button class="relative border border-l-neutral-200 border-y-transparent border-r-transparent sm:border-transparent rounded-r-2xl rounded-y-2xl" type="submit">
                <x-codicon-search class="text-cyan-500 w-5 hover:text-cyan-400  mx-2 sm:mr-2  sm:ml-0 " />
            </button> 
        </div>
        @if (request()->filled('country') || request()->filled('city') || request()->filled('start_date') || request()->filled('end_date') || request()->filled('sort_option') || request()->filled('category'))
                                      
        <a href="{{ route('offers.search') }}" class="hover:bg-neutral-200 text-sm text-neutral-500  bg-neutral-100 flex justify-center items-center mt-2 mx-auto ">Clear All Filters  <span class="mx-1">x</span> </a> 
        @endif 
                  
        </div>    
        
                {{-- CATEGORIES OPTIONS --}}
                {{-- <div class="grid grid-cols-5 sm:grid-cols-10 sm:space-y-0 justify-items-center my-2 text-xs 2xl:text-sm shadow-sm rounded-2xl lg:space-x-0 md:space-x-8 sm:space-x-10">
                    <div class="ml-2 mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2 grid grid-cols-1 justify-center">
                        <input type="hidden" id="category_all" name="category" value="all">
                        <div class="grid grid-cols-1 justify-center">
                            <label for="category_all" class="text-neutral-500 mx-auto cursor-pointer inline-block text-center">
                                <x-phosphor-house-line class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer" />
                                All 
                            </label>
                        </div>
                    </div>
                   
                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                        <input type="hidden" id="luxe" name="category" value="luxe">
                        <label for="luxe" class="text-neutral-500 mx-auto cursor-pointer inline-block text-center">
                        <x-phosphor-star-four  class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer " />
                        Luxe
                        </label>
                    </div>
                    
                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                        <input type="hidden" id="city" name="category" value="city"/>
                            <label for="city" class="text-neutral-500 cursor-pointer inline-block text-center">
                            <x-iconpark-cityone-o class="text-neutral-500 h-8 w-10 mx-auto  font-bold cursor-pointer " />
                            City
                        </label>
                    </div>

                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                        <input type="hidden" id="beach" name="category" value="beach">
                        <label for="beach" class="text-neutral-500 cursor-pointer inline-block text-center">
                            <x-iconpark-beachumbrella-o class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer " />
                            Beach
                        </label>
                    </div>
                    
                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                            <input type="hidden" id="rural" name="category" value="rural">
                            <label for="rural" class="text-neutral-500 cursor-pointer inline-block text-center">
                            <x-iconpark-naturalmode-o class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer " />
                            Rural
                            </label>
                    </div>

                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                            <input type="hidden" id="rural" name="category" value="rural">
                            <label for="rural" class="text-neutral-500 cursor-pointer inline-block text-center">
                            <x-phosphor-mountains class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer " />
                            Mountain
                            </label>
                    </div>

                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                        <input type="hidden" id="island" name="category" value="island">
                        <label for="island" class="text-neutral-500 cursor-pointer inline-block text-center">
                            <x-iconpark-coconuttree-o  class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer " />
                            Island
                        </label>
                    </div>

                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                        <input type="hidden" id="desert" name="category" value="desert">
                        <label for="desert" class="text-neutral-500 cursor-pointer  inline-block text-center">
                            <x-phosphor-cactus class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer" />
                            Desert
                        </label>
                    </div>

                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2">
                        <input type="hidden" id="traditional" name="category" value="traditional">
                        <label for="traditional" class="text-neutral-500 cursor-pointer inline-block text-center">
                            <x-iconpark-citygate-o class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer" />
                            Traditional
                        </label>
                    </div>

                    <div class="mt-2 rounded-lg bg-transparent hover:bg-neutral-200 focus:bg-neutral-200 focus:outline-none cursor-pointer max-w-fit p-2 mr-2">
                        <input type="hidden" id="boat" name="category" value="boat">
                        <label for="boat" class="text-neutral-500  cursor-pointer inline-block text-center">
                            <x-phosphor-boat class="text-neutral-500 h-8 w-10 mx-auto  cursor-pointer" />
                            Boat
                        </label>
                    </div>

                </div>  --}}
            