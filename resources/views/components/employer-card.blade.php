@props(['employer'])

<div class="bg-white/5 border border-white/10 rounded-xl p-5 hover:bg-white/8 hover:border-blue-500/30 transition-all duration-300 group cursor-pointer">
    <div class="flex justify-center mb-4">
        <x-employer-logo :employer="$employer" :size="56" class="rounded-xl" />
    </div>

    <div class="text-center">
        <h3 class="font-semibold text-white group-hover:text-blue-300 transition-colors mb-2 truncate">
            {{ $employer->name }}
        </h3>

        <div class="inline-flex items-center space-x-1 px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm mb-3">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
            </svg>
            <span>{{ $employer->jobs->count() }} {{ $employer->jobs->count() === 1 ? 'Job' : 'Jobs' }}</span>
        </div>


        <div>
            <a href="#"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center space-x-1 text-gray-400 hover:text-blue-400 transition-colors text-sm"
               onclick="event.stopPropagation()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>Visit Website</span>
            </a>
        </div>
    </div>
</div>


