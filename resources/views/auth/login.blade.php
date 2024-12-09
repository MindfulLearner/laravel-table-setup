<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-gradient-to-r from-neutral-900 via-neutral-800 to-neutral-900 p-8 rounded-xl shadow-lg w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="relative">
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none" type="email" name="email" :value="old('email')" required autofocus oninvalid="this.setCustomValidity('Per favore, inserisci una mail valida')" autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    @if ($errors->has('login'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('login') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" oninvalid="this.setCustomValidity('Per favore, inserisci la password')" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 text-black border focus:focus:ring-transparent dark:focus:ring-transparent border-gray-500 rounded" name="remember" oninvalid="this.setCustomValidity('Seleziona per ricordare la sessione')">
                    <label for="remember_me" class="ml-2 block text-sm text-white">
                        {{ __('Ricordami') }}
                    </label>
                </div>

                <div class="items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-white hover:underline rounded-md" href="{{ route('password.request') }}">
                            {{ __('Password dimenticata?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col space-y-4">

                    <x-primary-button class="w-full py-2 justify-center flex text-white font-semibold !rounded-2xl shadow border focus:focus:ring-transparent dark:focus:ring-transparent border-neutral-500">
                        {{ __('Accedi') }}
                    </x-primary-button>
                </div>

                <div class="text-center">
                    <label class="text-white text-sm">Non sei ancora Registrato?</label>
                    @if (Route::has('register'))
                        <a class="text-sm text-center text-white hover:underline rounded-md" href="{{ route('register') }}">
                            {{ __('Registrati') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
