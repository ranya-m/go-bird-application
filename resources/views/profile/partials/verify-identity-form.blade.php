<div>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Identity Information') }}
        </h2>
        
        <p class="mt-1 text-sm text-gray-600">
            @if (!$user->hasVerifiedIdentity() && !$user->hasUploadedIdentityDocument())
            {{ __("You must verify these informations first to be able to book.") }}
            @elseif($user->hasVerifiedIdentity())
            {{ __("Identity Verified") }}
            @elseif(!$user->hasVerifiedIdentity() && $user->hasUploadedIdentityDocument())
            {{ __("Request for verification submitted and will be processed soon.") }}
            @endif
        </p>
    </header>
    
    <form method="post" enctype="multipart/form-data" action="{{ route('verify-identity') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-text-input id="identity_number" name="identity_number" type="text" class="mt-1 block w-full" :value="old('identity_number', $user->identity_number ?? '')" required autofocus autocomplete="identity_number" :disabled="$user->hasVerifiedIdentity()" />

            <x-input-error class="mt-2" :messages="$errors->get('identity_number')" />           
        </div>

        <div class="flex items-start gap-4">
            <div class="w-1/2">
                <x-input-label for="identity_document" :value="__('National identification document')" />
                @if (!$user->hasUploadedIdentityDocument())
                    <input id="identity_document" name="identity_document" type="file" accept=".pdf,.jpeg,.jpg,.png" class="mt-1 block w-full" required autocomplete="identity_document" :disabled="$user->hasVerifiedIdentity()" value="{{ $filename ?? '' }}" />
                @else
                    <p class="text-green-500">Document Uploaded</p>
                @endif

                <x-input-error class="mt-2" :messages="$errors->get('identity_document')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            @if ($user->hasVerifiedIdentity())
                <p class="text-green-500">Identity Verified</p>
            @elseif(!$user->hasVerifiedIdentity() && !$user->hasUploadedIdentityDocument())
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                    Verify identity
                </button>
            @endif
        </div>
    </form>
</div>



