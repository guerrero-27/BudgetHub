<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6 sm:mb-8">
        <h2 class="text-xl sm:text-2xl font-bold text-white">Confirm Password</h2>
        <p class="text-gray-400 mt-1 sm:mt-2 text-sm sm:text-base">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

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

        <!-- Submit Button -->
        <div class="flex justify-end mt-4 sm:mt-6">
            <button type="submit" 
                    class="w-full sm:w-auto py-2.5 sm:py-3 px-4 sm:px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 btn-primary text-sm sm:text-base">
                Confirm
            </button>
        </div>
    </form>
</x-guest-layout>

