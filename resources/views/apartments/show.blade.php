@extends('dashboard')

@section('content')
  <div class="max-w-4xl mx-auto p-8 mt-10 bg-white shadow-lg rounded-lg">
    <!-- Apartment Title -->
    <h1 class="text-3xl font-bold text-yellow-600 mb-6 text-center">{{ $apartment->title }}</h1>

    <!-- Apartment Image -->
    <img src="{{ $apartment->cover_image }}" alt="Property Image" class="w-full h-64 object-cover mb-4 rounded-lg border-2 border-yellow-300" />

    <!-- Apartment Details -->
    <div class="mb-4 p-4 bg-gray-100 rounded-lg">
      <!-- Room Information -->
      <p class="text-lg text-gray-800"><strong>Stanze:</strong> <span class="text-yellow-600">{{ $apartment->rooms }}</span></p>
      <p class="text-lg text-gray-800"><strong>Letti:</strong> <span class="text-yellow-600">{{ $apartment->beds }}</span></p>
      <p class="text-lg text-gray-800"><strong>Bagni:</strong> <span class="text-yellow-600">{{ $apartment->bathrooms }}</span></p>
      <p class="text-lg text-gray-800"><strong>Metri Quadri:</strong> <span class="text-yellow-600">{{ $apartment->square_meters }} m²</span></p>

      <!-- Address Information -->
      <p class="text-lg text-gray-800"><strong>Indirizzo:</strong> <span class="text-yellow-600">{{ $apartment->address }}</span></p>

      <!-- Services Information -->
      <p class="text-lg text-gray-800"><strong>Servizi:</strong>
        <span class="text-yellow-600">
          @foreach ($apartment->services as $service)
            {{ $service->name }}@if (!$loop->last), @endif
          @endforeach
        </span>
      </p>

      <!-- Coordinates Information -->
      <p class="text-lg text-gray-800"><strong>Coordinate:</strong> <span class="text-yellow-600">{{ $apartment->latitude }}, {{ $apartment->longitude }}</span></p>

      <!-- Visibility Information -->
      <p class="text-lg text-gray-800"><strong>Visibilità:</strong> <span class="text-yellow-600">{{ $apartment->is_visible ? 'Visibile' : 'Non Visibile' }}</span></p>

      <br>

      <!-- Sponsorship Information -->
      <p class="text-lg text-gray-800"><strong>Sponsorizzazioni:</strong>
        <span class="text-yellow-600">
          @foreach ($apartment->sponsorships as $sponsorship)
            {{ $sponsorship->name }}@if (!$loop->last), @endif
          @endforeach
        </span>
      </p>
    </div>

    <!-- Apartment Images -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      @foreach ($images as $image)
        <img src="{{ $image->image_path }}" alt="Property Image" class="w-full h-32 object-cover rounded-lg border-2 border-yellow-300" />
        <p class="text-gray-800">{{ $image->description }}</p>
      @endforeach
    </div>

    <!-- messaggi ricebuti -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
      @foreach ($messages as $message)
        <div class="border-b border-gray-300 py-2">
            <p class="text-gray-800 font-semibold">Data: {{ $message->created_at }}</p>
          <p class="text-gray-800 font-semibold">Inviato da: <span class="text-blue-600">{{ $message->email_sender }}</span></p>
          <p class="text-gray-700 italic">{{ $message->message }}</p>
        </div>
      @endforeach
    </div>

    <!-- Back to Apartments List Link -->
    <a href="{{ route('apartments.index') }}" class="text-blue-500 hover:underline font-semibold">Torna alla lista degli appartamenti</a>
  </div>
@endsection
