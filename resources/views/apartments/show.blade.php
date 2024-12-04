@extends('dashboard')

@section('header', 'Dettagli appartamento')

@section('content')
<div class="max-w-4xl mx-auto bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 shadow-xl rounded-lg p-10 mt-10">

    <!-- Titolo dell'appartamento -->
    <h1 class="text-3xl font-extrabold text-gray-200 mb-8 text-center border-b-4 border-yellow-500 pb-4">
        {{ $apartment->title }}
    </h1>

    <!-- Immagine copertina dell'appartamento -->
    <img src="{{ $apartment->cover_image }}" alt="Property Image" class="w-full h-64 object-cover mb-8 rounded-lg border-2 shadow-xl border-neutral-700" />

    <!-- Dettagli dell'appartamento -->
    <div class="mb-8 p-8 bg-gradient-to-r from-neutral-800 via-neutral-700 to-neutral-800 rounded-xl shadow-md">
        <!-- Informazioni sulle stanze -->
        <p class="text-lg font-semibold text-gray-200"><strong>Stanze:</strong> <span class="text-yellow-500">{{ $apartment->rooms }}</span></p>
        <p class="text-lg font-semibold text-gray-200"><strong>Letti:</strong> <span class="text-yellow-500">{{ $apartment->beds }}</span></p>
        <p class="text-lg font-semibold text-gray-200"><strong>Bagni:</strong> <span class="text-yellow-500">{{ $apartment->bathrooms }}</span></p>
        <p class="text-lg font-semibold text-gray-200"><strong>Metri Quadri:</strong> <span class="text-yellow-500">{{ $apartment->square_meters }} m²</span></p>

        <!-- Informazioni sull'indirizzo -->
        <p class="text-lg font-semibold text-gray-200"><strong>Indirizzo:</strong> <span class="text-yellow-500">{{ $apartment->address }}</span></p>

        <!-- Informazioni sui servizi -->
        <p class="text-lg font-semibold text-gray-200"><strong>Servizi:</strong>
            <span class="text-yellow-500">
                @foreach ($apartment->services as $service)
                    {{ $service->name }}@if (!$loop->last), @endif
                @endforeach
            </span>
        </p>

        <!-- Informazioni sulle coordinate -->
        <p class="text-lg font-semibold text-gray-200"><strong>Coordinate:</strong> <span class="text-yellow-500">{{ $apartment->latitude }}, {{ $apartment->longitude }}</span></p>

        <!-- Informazioni sulla visibilità -->
        <p class="text-lg font-semibold text-gray-200"><strong>Visibilità:</strong> <span class="text-yellow-500">{{ $apartment->is_visible ? 'Visibile' : 'Non Visibile' }}</span></p>

        <br>

        <!-- Informazioni sulle sponsorizzazioni -->
        <p class="text-lg font-semibold text-gray-200"><strong>Sponsorizzazioni:</strong>
            <span class="text-yellow-500">
                @foreach ($apartment->sponsorships as $sponsorship)
                    {{ $sponsorship->name }}@if (!$loop->last), @endif
                @endforeach
            </span>
        </p>
    </div>

    <!-- Immagini aggiuntive dell'appartamento -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-8">
        @foreach ($images as $image)
            <div class="flex flex-col items-center bg-neutral-800 rounded-lg p-4 shadow-lg">
                <img src="{{ $image->image_path }}" alt="Property Image" class="w-full h-32 object-cover mb-4 rounded-lg border-2 shadow-xl border-neutral-700" />
                <p class="text-md text-gray-200">{{ $image->description }}</p>
            </div>
        @endforeach
    </div>
    <!-- Statistiche appartamento -->
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
    <!-- Messaggi ricevuti -->
    <div class="bg-neutral-800 p-6 rounded-lg shadow-md mb-10">
        <h2 class="text-2xl font-bold text-yellow-500 mb-6">Messaggi ricevuti</h2>
        @foreach ($messages as $message)
            <div class="border-b border-gray-600 py-4">
                <p class="text-lg text-gray-200 font-semibold mb-2">Data: <span class="text-yellow-500">{{ $message->created_at }}</span></p>
                <p class="text-lg text-gray-200 font-semibold mb-2">Inviato da: <span class="text-blue-400">{{ $message->email_sender }}</span></p>
                <p class="text-md text-gray-300 italic">{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <!-- Link per tornare alla lista degli appartamenti -->
    <div class="text-center">
        <a href="{{ route('apartments.index') }}" class="bg-[#967305] text-white px-6 py-3 rounded-lg shadow-lg font-bold hover:bg-yellow-500 transition-all ease-in-out duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            Torna alla lista degli appartamenti
        </a>
    </div>
</div>

@endsection
