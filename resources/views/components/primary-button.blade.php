<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-500 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:from-indigo-700 active:to-indigo-600 shadow-lg hover:shadow-indigo-500/25 transition-all duration-200']) }}>
    {{ $slot }}
</button>
