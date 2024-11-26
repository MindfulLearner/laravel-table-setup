@extends('dashboard')

@section('content')
{{-- form per editare un appartamento --}}

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Aggiorna Appartamento</h1>
    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="grid grid-cols-1 gap-6">
        <!-- Titolo -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
          <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $apartment->title) }}"
            placeholder="Inserisci un titolo..."
            class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
            required
          />
        </div>

        <!-- Stanze, Letti, Bagni -->
        <div class="grid grid-cols-3 gap-6">
          <!-- Stanze -->
          <div>
            <label for="rooms" class="block text-sm font-medium text-gray-700">Stanze</label>
            <input
              type="number"
              id="rooms"
              name="rooms"
              value="{{ old('rooms', $apartment->rooms) }}"
              placeholder="Inserisci il numero di stanze..."
              class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
              required
            />
          </div>

          <!-- Letti -->
          <div>
            <label for="beds" class="block text-sm font-medium text-gray-700">Letti</label>
            <input
              type="number"
              id="beds"
              name="beds"
              value="{{ old('beds', $apartment->beds) }}"
              placeholder="Inserisci il numero di letti..."
              class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
              required
            />
          </div>

          <!-- Bagni -->
          <div>
            <label for="bathrooms" class="block text-sm font-medium text-gray-700">Bagni</label>
            <input
              type="number"
              id="bathrooms"
              name="bathrooms"
              value="{{ old('bathrooms', $apartment->bathrooms) }}"
              placeholder="Inserisci il numero di bagni..."
              class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
              required
            />
          </div>
        </div>

        <!-- Metri Quadri con linea trascinabile -->
        <div>
          <label for="square_meters" class="block text-sm font-medium text-gray-700">Metri Quadri</label>
          <input
            type="range"
            id="square_meters"
            name="square_meters"
            min="20"
            max="200"
            value="{{ old('square_meters', $apartment->square_meters) }}"
            class="mt-1 w-full"
            oninput="this.nextElementSibling.value = this.value"
          />
          <output>{{ old('square_meters', $apartment->square_meters) }}</output> m²
        </div>

        <!-- Indirizzo -->
        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">Indirizzo</label>
          <input
            type="text"
            id="address"
            name="address"
            value="{{ old('address', $apartment->address) }}"
            placeholder="Inserisci l'indirizzo..."
            class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
            required
          />
        </div>

        <!-- Latitudine -->
        <div>
          <label for="latitude" class="block text-sm font-medium text-gray-700">Latitudine</label>
          <input
            type="text"
            id="latitude"
            name="latitude"
            value="{{ old('latitude', $apartment->latitude) }}"
            placeholder="Inserisci la latitudine..."
            class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          />
        </div>

        <!-- Longitudine -->
        <div>
          <label for="longitude" class="block text-sm font-medium text-gray-700">Longitudine</label>
          <input
            type="text"
            id="longitude"
            name="longitude"
            value="{{ old('longitude', $apartment->longitude) }}"
            placeholder="Inserisci la longitudine..."
            class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          />
        </div>

        <!-- Immagine -->
        <div>
          <label for="image" class="block text-sm font-medium text-gray-700">Immagine (URL/Path)</label>
          <input
            type="text"
            id="image"
            name="image"
            value="{{ old('image', $apartment->image) }}"
            placeholder="Inserisci l'URL dell'immagine..."
            class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
            required
          />
        </div>

        <!-- Visibilità -->
        <div class="flex items-center">
          <input
            id="is_visible"
            type="checkbox"
            name="is_visible"
            {{ $apartment->is_visible ? 'checked' : '' }}
            class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300 rounded"
          />
          <label for="is_visible" class="ml-2 text-sm font-medium text-gray-700">Visibile</label>
        </div>

        <!-- Pulsante Submit -->
        <div class="text-center">
          <button
            type="submit"
            class="bg-yellow-500 text-white font-medium px-6 py-2 rounded-md shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
          >
            Aggiorna Appartamento
          </button>
        </div>
      </div>
    </form>

    <!-- Messaggio di successo -->
    @if(session('success'))
      <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-md">
        <p>{{ session('success') }}</p>
      </div>
    @endif
  </div>
@endsection
