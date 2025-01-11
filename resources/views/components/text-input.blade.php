@props(['disabled' => false])

<input @disabled($disabled) 
       onchange="this.value = this.value.trim()"
       {{ $attributes->merge(['class' => 'w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] placeholder-[#94a3b8] focus:border-[#475569] focus:ring-2 focus:ring-[#475569] focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200']) }}>
