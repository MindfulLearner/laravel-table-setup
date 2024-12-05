<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900">
        <div class="bg-neutral-800 p-8 rounded-xl shadow-lg w-full max-w-md">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="email"
                                  name="email"
                                  :value="old('email', $request->email)"
                                  required autofocus autocomplete="username" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Conferma Password')" class="block text-sm font-medium text-white" />

                    <x-text-input id="password_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-neutral-700 text-white"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end">
                    <a class="text-sm text-yellow-400 hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded-md" href="{{ route('login') }}">
                        {{ __('Torna al login') }}
                    </a>
                </div>

                <div class="flex flex-col space-y-4">
                    <x-primary-button class="w-full py-2 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        {{ __('Reimposta Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
