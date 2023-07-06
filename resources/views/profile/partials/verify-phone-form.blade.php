<div class="max-w-2xl" id='phone-verification'>

    @if ($user->hasVerifiedPhone())
        <span class="text-green-500">Verified</span>
        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" disabled>
        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded" id="verify-different-phone">Verify a different phone number</button>
    @else
        <form method="POST" action="{{ route('verify-phone') }}">
            @csrf
            @method('patch')
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" @if ($user->hasPhone()) disabled @endif>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                @if ($user->hasPhone()) Verify a different phone number @else Verify phone number @endif
            </button>
        </form>
    @endif

    <!-- Code verification modal -->
    <div x-data="{ showModal: false }">
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-10">
            <div class="bg-white w-1/2 p-6 rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Code Verification</h2>
                <!-- Modal content goes here -->
                <input type="text" name="verification_code" id="verification_code">
                <button @click="showModal = false" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Submit Code</button>
                <button @click="showModal = false" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Close</button>
            </div>
        </div>
    
        <!-- Button to open the modal -->
        <button @click="showModal = true" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-2">
            Enter Verification Code
        </button>
    </div>
    


</div>
