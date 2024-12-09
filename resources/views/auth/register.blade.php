<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-gradient-to-r from-neutral-900 via-neutral-800 to-neutral-900 p-8 rounded-xl shadow-lg w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" class="block text-sm font-medium text-white" />
                    <x-text-input id="name" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" oninvalid="this.setCustomValidity('Inserisci il tuo nome')" oninput="this.setCustomValidity('')" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none" type="email" name="email" :value="old('email')" required autocomplete="username" oninvalid="this.setCustomValidity('Inserisci un indirizzo email valido')" oninput="this.setCustomValidity('')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" oninvalid="this.setCustomValidity('Inserisci una password')" oninput="this.setCustomValidity('')" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Conferma Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password_confirmation" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" oninvalid="this.setCustomValidity('Conferma la password')" oninput="this.setCustomValidity('')" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-white hover:underline focus:outline-none rounded-md" href="{{ route('login') }}">
                        {{ __('Hai già un account?') }}
                    </a>
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full py-2 justify-center flex text-white font-semibold !rounded-2xl shadow border focus:focus:ring-transparent dark:focus:ring-transparent border-neutral-500">
                        {{ __('Registrati') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
