<x-modal name="identity-document-modal" maxWidth="2xl">
    <div class="p-4">
        @if ($user->identity_document)
        <img src="{{ Storage::disk('identity_documents')->url($user->identity_document) }}" alt="Identity Document" class="max-w-xs">

        @endif
        <div class="mt-4 flex justify-end">
            <button @click="$dispatch('close-modal', { name: 'identity-document-modal' })" type="button" class="text-blue-600 hover:text-blue-900 focus:outline-none">
                {{ __('Close') }}
            </button>
        </div>
    </div>
</x-modal>





