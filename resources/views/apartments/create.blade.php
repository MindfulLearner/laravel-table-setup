<!-- Start of Selection -->
@extends('dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
  <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Crea un Nuovo Appartamento</h1>
  <form action="{{ route('apartments.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 gap-6">
      <!-- Titolo -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
        <input
          type="text"
          id="title"
          name="title"
          placeholder="Inserisci un titolo..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          value="Appartamento in Centro"
        />
      </div>

      <!-- Stanze -->
      <div>
        <label for="rooms" class="block text-sm font-medium text-gray-700">Stanze</label>
        <input
          type="number"
          id="rooms"
          name="rooms"
          placeholder="Inserisci il numero di stanze..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          min="1"
          value="3"
        />
      </div>

      <!-- Letti -->
      <div>
        <label for="beds" class="block text-sm font-medium text-gray-700">Letti</label>
        <input
          type="number"
          id="beds"
          name="beds"
          placeholder="Inserisci il numero di letti..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          min="1"
          value="2"
        />
      </div>

      <!-- Bagni -->
      <div>
        <label for="bathrooms" class="block text-sm font-medium text-gray-700">Bagni</label>
        <input
          type="number"
          id="bathrooms"
          name="bathrooms"
          placeholder="Inserisci il numero di bagni..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          min="1"
          value="1"
        />
      </div>

      <!-- Metri Quadri -->
      <div>
        <label for="square_meters" class="block text-sm font-medium text-gray-700">Metri Quadri</label>
        <input
          type="number"
          id="square_meters"
          name="square_meters"
          placeholder="Inserisci i metri quadri..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          value="75"
        />
      </div>

      <!-- Indirizzo -->
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700">Indirizzo</label>
        <input
          type="text"
          id="address"
          name="address"
          placeholder="Inserisci l'indirizzo..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          value="Via Roma, 123"
        />
      </div>

      <!-- Latitudine -->
      <div>
        <label for="latitude" class="block text-sm font-medium text-gray-700">Latitudine</label>
        <input
          type="text"
          id="latitude"
          name="latitude"
          placeholder="Inserisci la latitudine..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          value="41.9028"
        />
      </div>

      <!-- Longitudine -->
      <div>
        <label for="longitude" class="block text-sm font-medium text-gray-700">Longitudine</label>
        <input
          type="text"
          id="longitude"
          name="longitude"
          placeholder="Inserisci la longitudine..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          value="12.4964"
        />
      </div>

      <!-- Immagine -->
      <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Immagine (URL/Path)</label>
        <input
          type="text"
          id="image"
          name="image"
          placeholder="Inserisci l'URL dell'immagine..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          value="https://example.com/image.jpg"
        />
      </div>

      <!-- Visibilità -->
      <div class="flex items-center">
        <input type="hidden" name="is_visible" value="0"> 
        <input type="checkbox" name="is_visible" id="is_visible" value="1" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200">
        <label for="is_visible" class="ml-2 text-sm font-medium text-gray-700">Visibile</label>
      </div>

      <!-- Descrizione -->
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Descrizione</label>
        <textarea
          id="description"
          name="description"
          placeholder="Inserisci una descrizione dell'appartamento..."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
        >Appartamento luminoso e spazioso nel cuore della città.</textarea>
      </div>

      <!-- Pulsante Submit -->
      <div class="text-center">
        <button
          type="submit"
          class="bg-yellow-500 text-white font-medium px-6 py-2 rounded-md shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
        >
          Crea Appartamento
        </button>
      </div>
    </div>
  </form>

  <!-- Messaggio di successo -->
  <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-md">
    <p>Appartamento creato con successo!</p>
  </div>
</div>
@endsection
