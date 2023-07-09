
<section class='flex justify-around items-center'>
    <div class="w-2/5">
      <h1 class="text-2xl md:text-6xl 2xl:text-5xl font-bold tracking-tight mb-12">3 simple steps to start<br><span class="text-cyan-600">Your hosting journey</span></h1>
  
      <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
        <input required type="checkbox" name="agree_to_host_terms" x-model="agreeToHostTerms" value="1"
          class="relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
          type="checkbox"
          value=""
          id="checkboxDefault" />
        <label
          class="inline-block pl-[0.15rem] hover:cursor-pointer"
          for="checkboxDefault">
          To continue, please read and confirm your agreement to the Hosting
          <span><a href="#" @click="showModal = true" class="text-blue-500">Terms and Conditions</a></span>
        </label>
      </div>
    
      {{-- MODAL BOX: details of host terms --}}
      <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div x-show.transition.opacity="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-neutral-500 opacity-75"></div>
          </div>
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          <div x-show.transition="showModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-neutral-100 sm:mx-0 sm:h-10 sm:w-10">
                  <svg class="h-6 w-6 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg leading-6 font-medium text-neutral-900">
                    Terms and Conditions
                  </h3>
                  <div class="mt-2">
                    <p class="text-sm text-neutral-500">
                      Please read and agree to the terms and conditions to continue.
                    </p>
    
                    <p class="text-sm text-neutral-500 p-4">
                      Fuga consequuntur at molestias expedita dolorum, saepe, explicabo maiores soluta ipsam delectus praesentium omnis necessitatibus debitis. Quae doloribus possimus dolore numquam error exercitationem id adipisci quidem molestias deserunt fuga consectetur, libero odio iusto. Deleniti praesentium ea exercitationem suscipit expedita quasi laudantium, nesciunt commodi earum placeat nisi.
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Est minus accusantium numquam facere, dignissimos quibusdam iusto qui quo expedita cupiditate nisi illum voluptates distinctio non necessitatibus quas sit autem saepe eius veniam fuga praesentium a porro quos. Incidunt nemo error, quasi esse obcaecati sequi at architecto perspiciatis quis maxime in beatae assumenda, ab deserunt.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-neutral-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <button type="button" @click="showModal = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cyan-600 text-base font-medium text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:ml-3 sm:w-auto sm:text-sm">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    
      
    </div>

  <div class="p-10 w-1/2 flex flex-col space-y-2">
    <div
      class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
      <h5
        class="mb-2 text-2xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
        Verify your identity
      </h5>
      <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, mollitia eos pariatur ex sequi iusto doloremque rerum tempore laborum recusandae. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, officiis.
      </p>
    </div>

    <div
      class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
      <h5
        class="mb-2 text-2xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
        Register your phone number
      </h5>
      <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, mollitia eos pariatur ex sequi iusto doloremque rerum tempore laborum recusandae.
      </p>
    </div>

    <div
      class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
      <h5
        class="mb-2 text-2xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
        Create your listing
      </h5>
      <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, mollitia eos pariatur ex sequi iusto doloremque rerum tempore laborum recusandae.
      </p>
    </div>
  </div>
</section>
