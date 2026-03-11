<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6 sm:mb-8">
        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-indigo-600/20 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-white">Verify Your Email</h2>
        <p class="text-gray-400 mt-1 sm:mt-2 text-sm sm:text-base">Thanks for signing up! Please verify your email address.</p>
    </div>

    <div class="mb-5 sm:mb-6 text-sm text-gray-400 bg-gray-700/30 rounded-lg sm:rounded-xl p-3 sm:p-4">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 sm:mb-5 font-medium text-sm text-green-400 bg-green-400/10 rounded-lg sm:rounded-xl p-3 sm:p-4">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-5 sm:mt-6 flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto order-2 sm:order-1">
            @csrf

            <button type="submit" 
                    class="w-full sm:w-auto py-2.5 sm:py-3 px-4 sm:px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 btn-primary text-sm sm:text-base">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="order-1 sm:order-2">
            @csrf

            <button type="submit" class="text-gray-400 hover:text-indigo-400 transition-colors text-sm">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>

