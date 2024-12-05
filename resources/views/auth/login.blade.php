<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-neutral-800 p-8 rounded-xl shadow-lg w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-500 rounded" name="remember">
                    <label for="remember_me" class="ml-2 block text-sm text-white">
                        {{ __('Ricordami') }}
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('password.request') }}">
                            {{ __('Password dimenticata?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col space-y-4">
                    @if (Route::has('register'))
                        <a class="text-sm text-center text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('register') }}">
                            {{ __('Registrati') }}
                        </a>
                    @endif

                    <x-primary-button class="w-full py-2 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        {{ __('Accedi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
