@extends('dashboard')

@section('header', 'Statistiche appartamento')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-red-200">
                {{ __("Statistiche appartamento") }}
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-3">
                {{ $views->count() }} {{ __("visualizzazioni") }}
            </div>
            <div class="mt-3">
                <p>IP visitatori</p>
                @foreach ($views as $view)
                    <p>{{ $view->ip_address }}</p>
                    <p>{{ $view->created_at }}</p>
                    <p>{{ $view->id }}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
