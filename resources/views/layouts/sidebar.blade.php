<aside 
    x-data="{ 
        sidebarCollapsed: true,
        isMobile: window.innerWidth < 768
    }"
    x-init="
        isMobile = window.innerWidth < 768;
        window.addEventListener('resize', () => { isMobile = window.innerWidth < 768; });
        window.addEventListener('toggle-sidebar', () => { 
            if (isMobile) sidebarCollapsed = !sidebarCollapsed; 
        });
    "
    :class="[isMobile ? (sidebarCollapsed ? 'w-0' : 'w-64') : 'w-64']"
    class="fixed left-0 top-0 h-screen bg-white border-r border-gray-200 text-black flex flex-col transition-all duration-300 z-50 overflow-hidden"
    :style="isMobile ? 'transform: translateX(' + (sidebarCollapsed ? '-100%' : '0') + ')' : ''"
>
    <!-- Mobile Toggle Button (hamburger) -->
    <div class="flex justify-end mb-2">
        <button 
            x-show="isMobile"
            @click="sidebarCollapsed = !sidebarCollapsed" 
            class="p-2 rounded-lg hover:bg-gray-100 transition-colors text-gray-600"
            :title="sidebarCollapsed ? 'Show Sidebar' : 'Hide Sidebar'"
        >
            <svg x-show="sidebarCollapsed" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="!sidebarCollapsed" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar Content -->
    <div x-show="!isMobile || !sidebarCollapsed" x-transition.opacity class="flex flex-col h-full">
        <!-- Logo/Brand -->
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-black">Expenses</h1>
            <p class="text-gray-400 text-sm">Tracking App</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2">
            <a href="{{ route('dashboard') }}" @click="if(isMobile) sidebarCollapsed = true" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white' : 'text-black hover:bg-indigo-500 hover:text-white' }} transition-colors mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="ml-3 whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('expenses.index') }}" @click="if(isMobile) sidebarCollapsed = true" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('expenses.*') ? 'bg-indigo-700 text-white' : 'text-black hover:bg-indigo-500 hover:text-white' }} transition-colors mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="ml-3 whitespace-nowrap">Expenses</span>
            </a>

            <a href="{{ route('categories.index') }}" @click="if(isMobile) sidebarCollapsed = true" class="flex items-center px-3 py-3 rounded-lg {{ request()->routeIs('categories.*') ? 'bg-indigo-700 text-white' : 'text-black hover:bg-indigo-500 hover:text-white' }} transition-colors mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span class="ml-3 whitespace-nowrap">Categories</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-2 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" @click="if(isMobile) sidebarCollapsed = true" class="w-full flex items-center px-3 py-2 text-black hover:text-white hover:bg-indigo-700 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="ml-3 whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Overlay with Blur -->
<div 
    x-show="isMobile && !sidebarCollapsed"
    @click="sidebarCollapsed = true"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-30"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-30"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black backdrop-blur-sm z-40"
    style="display: none;"
></div>