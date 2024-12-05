<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-gradient-to-r from-neutral-900 via-neutral-800 to-neutral-900 p-8 rounded-xl shadow-lg w-full max-w-md">
            <div class="mb-4 text-sm text-white">
                {{ __('Hai dimenticato la password? Nessun problema. Inserisci il tuo indirizzo email e ti invieremo un link per reimpostarla.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border focus:focus:ring-white dark:focus:ring-white border-neutral-500 rounded-md shadow-sm !bg-black text-white focus:border-none" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                
                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full py-2 justify-center flex text-white font-semibold !rounded-2xl shadow border focus:focus:ring-transparent dark:focus:ring-transparent border-neutral-500">
                        {{ __('Invia Link di Reimpostazione Password') }}
                    </x-primary-button>
                </div>
                <div class="flex items-center justify-center">
                    <a class="text-sm text-white hover:underline focus:outline-none rounded-md" href="{{ route('login') }}">
                        {{ __('Torna al login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
