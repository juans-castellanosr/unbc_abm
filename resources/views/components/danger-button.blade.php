<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-red-500 hover:to-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:from-red-700 active:to-red-600 shadow-lg hover:shadow-red-500/25 transition-all duration-200']) }}>
    {{ $slot }}
</button>
