@extends('dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
          placeholder="Es. Appartamento in Centro"
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
        />
      </div>

      <div class="grid grid-cols-3 gap-6">
        <!-- Stanze -->
        <div>
          <label for="rooms" class="block text-sm font-medium text-gray-700">Stanze</label>
          <input
            type="number"
            id="rooms"
            name="rooms"
            placeholder="Es. 3"
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
            placeholder="Es. 2"
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
            placeholder="Es. 1"
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
          class="mt-1 w-full"
          oninput="this.nextElementSibling.value = this.value"
        />
        <output>75</output> m²
      </div>

      <!-- Indirizzo -->
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700">Indirizzo</label>
        <input
          type="text"
          id="address"
          name="address"
          placeholder="Es. Via Roma, 123"
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
        />
        <p id="address-result">
            Cercavi l'indirizzo: <span id="address-result-text"></span>
        </p>
      </div>

      <!-- Immagine -->
      <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Immagine (URL/Path)</label>
        <input
          type="text"
          id="image"
          name="image"
          placeholder="Es. https://example.com/image.jpg"
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
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
          placeholder="Es. Appartamento luminoso e spazioso nel cuore della città."
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
        ></textarea>
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

</div>

<script>
  document.getElementById('address').addEventListener('input', async function() {
    const apiTomTomKey = "{{ env('API_TOMTOM_KEY') }}";
    const url = "https://api.tomtom.com/search/2/geocode/" + encodeURIComponent(this.value) + ".json?key=" + apiTomTomKey + "&limit=1&countrySet=IT&language=it-IT";
    const response = await fetch(url);
    const data = await response.json();
    document.getElementById('address-result-text').innerHTML = data['results'][0]['address']['freeformAddress'];
  });
</script>
@endsection
