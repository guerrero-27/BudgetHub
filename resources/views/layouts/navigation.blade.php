<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between px-10 py-4">
        <!-- Mobile Menu Toggle -->
        <button 
            x-data="{ isMobile: window.innerWidth < 768 }"
            x-init="
                window.addEventListener('resize', () => { isMobile = window.innerWidth < 768; })
            "
            x-show="isMobile"
            @click="$dispatch('toggle-sidebar')" 
            class="p-2 rounded-lg hover:bg-gray-100 transition-colors text-gray-600"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h2 class="text-xl font-semibold text-gray-800">
            @yield('title', 'Dashboard') {{-- default: Dashboard --}}
        </h2>

        <div class="flex items-center gap-4">
            <span class="text-gray-600">{{ Auth::user()->name }}</span>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                 alt="Avatar" 
                 class="w-8 h-8 rounded-full">
        </div>
    </div>
</header>

