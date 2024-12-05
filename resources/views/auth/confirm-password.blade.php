<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-neutral-800 p-8 rounded-xl shadow-lg w-full max-w-md">
            <div class="mb-4 text-sm text-white">
                {{ __('Per continuare, inserisci la tua password.') }}
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('forgot-password') }}">
                        {{ __('Password dimenticata?') }}
                    </a>

                    <a class="text-sm text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('register') }}">
                        {{ __('Crea un account') }}
                    </a>
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full py-2 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        {{ __('Conferma Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
