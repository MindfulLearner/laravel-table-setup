@extends('dashboard')

@section('content')
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-red-200">
              {{ __("You're logged in!") }}


              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-3">
              @foreach ($apartments as $apartment)
              <div
              class="w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden transform transition-transform duration-300 cursor-pointer hover:scale-95"
              x-show="isVisible"
            >
              <img
                src="{{ $apartment->image }}"
                alt="Property Image"
                class="w-full h-48 object-cover"
              />
              <div class="p-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $apartment->title }}</h2>
                <div class="flex items-center text-gray-600 text-sm mb-2">
                  <span class="mr-2"><strong>Stanze:</strong> {{ $apartment->rooms }}</span>
                  <span class="mr-2"><strong>Letti:</strong> {{ $apartment->beds }}</span>
                  <span><strong>Bagni:</strong> {{ $apartment->bathrooms }}</span>
                </div>
                <div class="text-gray-600 text-sm">
                  <p><strong>Metri Quadri:</strong> {{ $apartment->square_meters }} m²</p>
                  <p><strong>Indirizzo:</strong> {{ $apartment->address }}</p>
                  <p><strong>Coordinate:</strong> {{ $apartment->latitude }}, {{ $apartment->longitude }}</p>
                </div>
                <div class="mt-4 flex justify-between">
                  <a href="{{ route('apartments.show', $apartment->id) }}" class="bg-green-500 text-white px-4 py-2 rounded">
                    Vai
                  </a>
                </div>
              </div>
            </div>
              @endforeach
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
