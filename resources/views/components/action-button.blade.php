<a {{ $attributes->merge(['class' => 'cursor-pointer inline-flex items-center px-6 py-3 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-base sm:text-lg font-medium hover:from-indigo-500 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:from-indigo-700 active:to-indigo-600 shadow-lg hover:shadow-indigo-500/25 transition-all duration-200']) }}>
    {{ $slot }}
</a>
