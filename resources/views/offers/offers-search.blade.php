    <form x-on:submit="submitForm" action="{{ route('offers.search') }}" method="GET" class="mt-2">
        <div class="w-full xs:mx-auto text-center xs:w-fit rounded-2xl border border-solid border-neutral-200 focus:border-transparent focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none transition duration-200 ease-in-out focus:z-[3] shadow-md hover:shadow-lg">

            {{-- DESTINATION AND DATES OPTIONS --}}
            <div class="xs:flex flex-nowrap">
            <div class="text-xs 2xl:text-base grid grid-cols-1 xs:grid-cols-3  ">
                <label
                for="country"
                class="block overflow-hidden border border-t-transparent border-x-transparent border-b-neutral-200 xs:border-transparent focus:border-transparent pt-0 xs:pt-1"
                >
                <span class="destination text-xs font-medium text-gray-500"> Destination </span>
                <input
                type="text"
                name="country"
                id="country"
                value="{{ request()->input('country') }}" 
                placeholder="Anywhere"
                class=" mx-auto text-center sm:m-0 sm:text-center place-items-center border border-transparent focus:border-transparent relative block  min-w-0 flex-auto bg-transparent  font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-xs 2xl:text-base 
                "
                />
                </label>
                <label
                for="start_date"
                class="block overflow-hidden border  border-transparent xs:border-y-transparent xs:border-x-neutral-200  focus:border-transparent pt-1 "
                >
                <span class="text-xs font-medium text-gray-500 "> Start Date </span>
                <input
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
                <span class="text-xs font-medium text-gray-500"> End Date </span>
                <input
                type="date"
                name="end_date"
                id="end_date"
                value="{{ request()->input('end_date') }}" 
                placeholder=""
                class="mx-auto text-center place-items-center  border border-transparent focus:border-transparent relative m-0 block min-w-0 flex-auto bg-transparent font-normal leading-[1.6] text-neutral-700 outline-none focus:outline-none focus:ring-0 text-xs 2xl:text-base"
                />

                
                
                </label>
                
                
            </div> 
            <button class="relative py-2 xs:py-0 rounded-r-2xl rounded-y-2xl px-2 md:mr-2 md:ml-0 hover:opacity-70 flex mx-auto text-center place-items-center" type="submit">
                <span class="text-xs font-semibold text-gray-800  justify-center content-center mr-2 xs:hidden">Search </span>
                <img src="/search.png" alt="Search" class="w-9 rounded-full">
            </button>

             
        </div>
        @if (request()->filled('country') || request()->filled('city') || request()->filled('start_date') || request()->filled('end_date') || request()->filled('sort_option') || request()->filled('category'))
                                      
        <a href="{{ route('offers.search') }}" class="hover:bg-neutral-200 text-xs text-neutral-500  bg-neutral-100 flex justify-center items-center py-0.5 mx-auto ">Clear All Filters  <img src="/x.png" alt="Logo" class="w-5 ml-1"> </a> 
        @endif 
                  
        </div>    
        

{{-- CATEGORIES OPTIONS --}}
<div class="justify-items-center justify-center mt-4 grid grid-cols-5 sm:grid-cols-10 my-2 text-xs 2xl:text-xs border border-b-neutral-100 shadow-xs rounded-2xl border-t-transparent border-x-transparent">
    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => null])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(empty(Request::input('category'))) border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_all" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/all.png" alt="Logo" class="w-7 justify-self-center">
            All
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'luxe'])) }}" class=" bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'luxe') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_luxe" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/luxe.png" alt="Logo" class="w-7 justify-self-center">
            Luxe
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'city'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'city') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_city" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/city.png" alt="Logo" class="w-7 justify-self-center">
            City
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'beach'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'beach') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_beach" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/beach.png" alt="Logo" class="w-7 justify-self-center">
            Beach
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'rural'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'rural') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_rural" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/rural.png" alt="Logo" class="w-7 justify-self-center">
            Rural
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'mountain'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'mountain') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_mountain" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/mountain.png" alt="Logo" class="w-7 justify-self-center">
            Mountain
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'desert'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'desert') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_desert" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/desert.png" alt="Logo" class="w-7 justify-self-center">
            Desert
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'traditional'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'traditional') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_traditional" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/traditional.png" alt="Logo" class="w-7 justify-self-center">
            Traditional
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'boat'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'boat') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_boat" class="text-neutral-500 mx-auto cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/boat.png" alt="Logo" class="w-7 justify-self-center">
            Boat
        </label>
    </a>

    <a href="{{ route('offers.search', array_merge(request()->except('category'), ['category' => 'island'])) }}" class="bg-transparent hover:opacity-50 focus:outline-none cursor-pointer max-w-fit p-2 @if(Request::input('category') === 'island') border border-b-2 border-b-cyan-500 border-x-transparent border-t-transparent @endif">
        <label for="category_island" class="text-neutral-500 cursor-pointer grid grid-rows-2 text-center">
            <img src="/category/island.png" alt="Logo" class="w-7 justify-self-center">
            Island
        </label>
    </a>
</div>

