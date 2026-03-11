<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-white">Reset Password</h2>
            <p class="text-gray-400 mt-1 sm:mt-2 text-sm sm:text-base">Choose a new password for your account</p>
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
                   :value="old('email', $request->email)" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4 sm:mb-5">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                New Password
            </label>
            <input id="password" 
                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-700/50 border border-gray-600 rounded-lg sm:rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm sm:text-base" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-5 sm:mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                Confirm Password
            </label>
            <input id="password_confirmation" 
                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-700/50 border border-gray-600 rounded-lg sm:rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm sm:text-base" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-2.5 sm:py-3.5 px-4 sm:px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 btn-primary text-sm sm:text-base">
            Reset Password
        </button>
    </form>
</x-guest-layout>

