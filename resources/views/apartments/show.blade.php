@extends('dashboard')

@section('content')
  <div class="max-w-4xl mx-auto p-8 mt-10 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold text-yellow-600 mb-6 text-center">{{ $apartment->title }}</h1>
    <img src="{{ $apartment->image }}" alt="Property Image" class="w-full h-64 object-cover mb-4 rounded-lg border-2 border-yellow-300" />
    <div class="mb-4 p-4 bg-gray-100 rounded-lg">
      <p class="text-lg text-gray-800"><strong>Stanze:</strong> <span class="text-yellow-600">{{ $apartment->rooms }}</span></p>
      <p class="text-lg text-gray-800"><strong>Letti:</strong> <span class="text-yellow-600">{{ $apartment->beds }}</span></p>
      <p class="text-lg text-gray-800"><strong>Bagni:</strong> <span class="text-yellow-600">{{ $apartment->bathrooms }}</span></p>
      <p class="text-lg text-gray-800"><strong>Metri Quadri:</strong> <span class="text-yellow-600">{{ $apartment->square_meters }} m²</span></p>
      <p class="text-lg text-gray-800"><strong>Indirizzo:</strong> <span class="text-yellow-600">{{ $apartment->address }}</span></p>
      <p class="text-lg text-gray-800"><strong>Servizi:</strong>
        <span class="text-yellow-600">
          @foreach ($apartment->services as $service)
            {{ $service->name }}@if (!$loop->last), @endif
          @endforeach
        </span>
      </p>
      <p class="text-lg text-gray-800"><strong>Coordinate:</strong> <span class="text-yellow-600">{{ $apartment->latitude }}, {{ $apartment->longitude }}</span></p>
      <p class="text-lg text-gray-800"><strong>Visibilità:</strong> <span class="text-yellow-600">{{ $apartment->is_visible ? 'Visibile' : 'Non Visibile' }}</span></p>
      <br>
      <p class="text-lg text-gray-800"><strong>Sponsorizzazioni:</strong>
        <span class="text-yellow-600">
          @foreach ($apartment->sponsorships as $sponsorship)
            {{ $sponsorship->name }}@if (!$loop->last), @endif
          @endforeach
        </span>
      </p>
    </div>
    <a href="{{ route('apartments.index') }}" class="text-blue-500 hover:underline font-semibold">Torna alla lista degli appartamenti</a>
  </div>
@endsection
