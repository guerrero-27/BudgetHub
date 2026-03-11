<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6 sm:mb-8">
        <h2 class="text-xl sm:text-2xl font-bold text-white">Forgot Password</h2>
        <p class="text-gray-400 mt-1 sm:mt-2 text-sm sm:text-base">No problem. Just enter your email and we'll send you a reset link.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

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
                   placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-2.5 sm:py-3.5 px-4 sm:px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 btn-primary text-sm sm:text-base">
            Send Reset Link
        </button>

        <!-- Back to Login -->
        <div class="mt-5 sm:mt-6 text-center">
            <a href="{{ route('login') }}" class="text-gray-400 hover:text-indigo-400 transition-colors text-sm">
                Back to Sign In
            </a>
        </div>
    </form>
</x-guest-layout>

