<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-neutral-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-600 focus:bg-cyan-600 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
