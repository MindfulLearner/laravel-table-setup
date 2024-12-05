<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-neutral-800 p-8 rounded-xl shadow-lg w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" class="block text-sm font-medium text-white" />
                    <x-text-input id="name" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Conferma Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('login') }}">
                        {{ __('Hai già un account?') }}
                    </a>
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full py-2 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        {{ __('Registrati') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
