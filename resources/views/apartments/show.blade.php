@extends('dashboard')

@section('content')
  <div class="max-w-4xl mx-auto p-8 mt-10 bg-gray-50">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">{{ $apartment->title }}</h1>
    <img src="{{ $apartment->image }}" alt="Property Image" class="w-full h-64 object-cover mb-4 rounded" />
    <div class="mb-4">
      <p class="text-lg"><strong>Stanze:</strong> {{ $apartment->rooms }}</p>
      <p class="text-lg"><strong>Letti:</strong> {{ $apartment->beds }}</p>
      <p class="text-lg"><strong>Bagni:</strong> {{ $apartment->bathrooms }}</p>
      <p class="text-lg"><strong>Metri Quadri:</strong> {{ $apartment->square_meters }} m²</p>
      <p class="text-lg"><strong>Indirizzo:</strong> {{ $apartment->address }}</p>
      <p class="text-lg"><strong>Coordinate:</strong> {{ $apartment->latitude }}, {{ $apartment->longitude }}</p>
      <p class="text-lg"><strong>Visibilità:</strong> {{ $apartment->is_visible ? 'Visibile' : 'Non Visibile' }}</p>
    </div>
    <a href="{{ route('apartments.index') }}" class="text-blue-500 hover:underline">Torna alla lista degli appartamenti</a>
  </div>
@endsection
