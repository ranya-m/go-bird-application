<x-app-layout>
    
        <!-- Multi steps form to become host -->
      <div x-data="{ hostStep: 0, showModal: false, agreeToHostTerms: false, showError: false }">
        <form action="{{ route('become.host') }}" method="POST">
          @csrf
            {{-- hostStep 0 : overview & terms conditions --}}
            <div x-show="hostStep === 0">
              @include('profile.partials.agree-to-host-terms')
            </div> 
              {{-- Continue button --}}
              <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">
                <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cyan-600 text-base font-medium text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:ml-3 sm:w-auto sm:text-sm" type='submit'>Submit</button>
              
              </div>
        </form>

            {{-- Continue button --}}
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">
              <button type="button" x-show="agreeToHostTerms" @click="hostStep = 1" class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                Continue
              </button>
            </div>

            {{-- hostStep 1 : --}}
            <div x-show="hostStep === 1">
              @include('profile.partials.verify-identity-form')
              {{-- Continue button --}}
                  <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:justify-between">
                    <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cyan-600 text-base font-medium text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:ml-3 sm:w-auto sm:text-sm" @click="hostStep = 0" type="button">Back</button>
                    {{-- Continue button --}}
                  <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row">
                    <button type="button" x-show="agreeToHostTerms" @click="hostStep = 2" class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                      Continue
                    </button>
                  </div>                    
            </div>

             {{-- hostStep 2 : --}}
              <div x-show="hostStep === 2">
                  @include('profile.partials.verify-phone-form')
              {{-- Continue button --}}
                  <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:justify-between">
                    <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cyan-600 text-base font-medium text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:ml-3 sm:w-auto sm:text-sm" @click="hostStep = 1" type="button">Back</button>
                    
              </div>
            </div>
        </form>                  
      </div>
  
</x-app-layout>