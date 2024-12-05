<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-neutral-800 p-8 rounded-xl shadow-lg w-full max-w-md">
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
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-end">
                    <a class="text-sm text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('login') }}">
                        {{ __('Torna al login') }}
                    </a>
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full py-2 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        {{ __('Invia Link di Reimpostazione Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
