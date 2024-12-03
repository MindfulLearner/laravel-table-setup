<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight">
            @yield('header')
        </h2>
    </x-slot>

    @yield('content')
</x-app-layout>
