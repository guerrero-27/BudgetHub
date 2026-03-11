<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-white">Welcome Back</h2>
            <p class="text-gray-400 mt-1 sm:mt-2 text-sm sm:text-base">Sign in to your account to continue</p>
        </div>

        <!-- Email Address -->
        <div class="mb-4 sm:mb-5">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                Email Address
            </label>
            <input id="email" 
                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-700/50 border border-gray-600 rounded-lg sm:rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm sm:text-base" 
                   type="email" 
                   name="email" 
                   :value="old('email')" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4 sm:mb-5">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                Password
            </label>
            <input id="password" 
                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-700/50 border border-gray-600 rounded-lg sm:rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm sm:text-base" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 sm:mb-6 gap-3 sm:gap-0">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-gray-600 bg-gray-700 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-gray-800" 
                       name="remember">
                <span class="ml-2 text-sm text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors whitespace-nowrap" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-2.5 sm:py-3.5 px-4 sm:px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 btn-primary text-sm sm:text-base">
            Sign In
        </button>

        <!-- Register Link -->
        <div class="mt-5 sm:mt-6 text-center">
            <p class="text-gray-400 text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                    Sign up free
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

