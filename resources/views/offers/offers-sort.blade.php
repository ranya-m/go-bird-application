    {{-- SORT BY --}}
        <select name="sort" id="sort" onchange="this.form.submit()" class="rounded-xl border border-solid border-neutral-300  focus:border-neutral-300 transition duration-200 ease-in-out focus:z-[3] py-1 hover:shadow-md focus:outline-none ring-0 focus:ring-0 text-xs 2xl:text-base text-neutral-700">
            <option class="text-center" value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Sort by</option>
            <option class="text-center"  value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
            <option class="text-center"  value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
            <option class="text-center"  value="top_rated" {{ request('sort') == 'top_rated' ? 'selected' : '' }}>Top Rated</option>
            <option class="text-center"  value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Offers</option>
            <option class="text-center"  value="most_popular" {{ request('sort') == 'most_popular' ? 'selected' : '' }}>Most Popular</option>
        </select>      
    </form>