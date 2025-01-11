<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-800 to-gray-700 border border-slate-600/50 rounded-lg font-semibold text-xs text-slate-200 uppercase tracking-widest hover:border-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 shadow-lg hover:shadow-slate-700/25 transition-all duration-200']) }}>
    {{ $slot }}
</button>
