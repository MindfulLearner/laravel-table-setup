<x-app-layout>

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @yield('content')
</x-app-layout>
