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
  <form action="{{ route('apartments.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="grid grid-cols-1 gap-6">
      <!-- Titolo -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
        <input
          type="text"
          id="title"
          name="title"
          value="Appartamento in Centro"
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
            value="3"
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
            value="2"
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
            value="1"
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
          value="75"
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
          value="Via Roma, 123"
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
        />
        <p id="address-result">
            Cercavi l'indirizzo: <span id="address-result-text"></span>
        </p>
      </div>

         <!-- Servizi -->
         <div>
            <label for="services" class="block text-sm font-medium text-gray-700">Servizi</label>
            <div class="space-y-2">
              @foreach ($services as $service)
                <div class="flex items-center">
                  <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200">
                  <label for="service_{{ $service->id }}" class="ml-2 text-sm font-medium text-gray-700">{{ $service->name }}</label>
                </div>
              @endforeach
              <br>
              <label for="sponsorships" class="block text-sm font-medium text-gray-700">Sponsorizzazioni</label>
              @foreach ($sponsorships as $sponsorship)
                <div class="flex items-center">
                  <input type="radio" id="sponsorship_{{ $sponsorship->id }}" name="sponsorship" value="{{ $sponsorship->id }}" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200">
                  <label for="sponsorship_{{ $sponsorship->id }}" class="ml-2 text-sm font-medium text-gray-700">{{ $sponsorship->name }}</label>
                </div>
              @endforeach
            </div>
          </div>

      <!-- Immagine Copertina -->
      <div>
        <label for="cover_image" class="block text-sm font-medium text-gray-700">Carica Immagine di copertina (Upload)</label>
        <input
          type="file"
          id="cover_image"
          name="cover_image"
          accept="image/*"
          class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
          required
          onchange="previewImage(event)"
        />
      </div>
      <div>
        <img id="image-preview" alt="Immagine Copertina" class="w-1/2 h-auto" style="display: none;">
        <button id="remove-image-button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" style="display: none;" onclick="resetFileInput()">Rimuovi Immagine</button>
      </div>

      <!-- carica altre immagini non copertina -->
      <div>
        <label for="other_images" class="block text-sm font-medium text-gray-700">Carica altre immagini (Upload)</label>
        <input
          type="file"
          id="other_images"
          name="other_images"
          accept="image/*"
          class="hidden"
          multiple
          onchange="previewListImage(event)"
        />
        <label for="other_images" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500 cursor-pointer">
          Seleziona immagini
        </label>
      </div>
      <div id="image-list-preview-container">
        <!--  chiama previewListImage() e verra caricato qui -->
        <div id="image-list-remove-button">
            <!-- qui verra messo il bottone per rimuovere l'immagine -->
        </div>
      </div>

      <!-- Visibilità -->
      <div class="flex items-center">
        <input type="hidden" name="is_visible" value="0">
        <input type="checkbox" name="is_visible" id="is_visible" value="1" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200" checked>
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

</div>

<script>

  // 1. init globale reader per leggere le immagini
  const reader = new FileReader();

  document.getElementById('address').addEventListener('input', async function() {
    const apiTomTomKey = "{{ env('API_TOMTOM_KEY') }}";
    const url = "https://api.tomtom.com/search/2/geocode/" + encodeURIComponent(this.value) + ".json?key=" + apiTomTomKey + "&limit=1&countrySet=IT&language=it-IT";
    const response = await fetch(url);
    const data = await response.json();
    document.getElementById('address-result-text').innerHTML = data['results'][0]['address']['freeformAddress'];
  });

  /**
   * Funzione per vedere l'immagine copertina
   */
  function previewImage(event) {
    const imagePreview = document.getElementById('image-preview');
    const file = event.target.files[0];


    // 2. se c'è un file lo legge
    if (file) {
      reader.readAsDataURL(file);
    } else {
      imagePreview.src = '';
      imagePreview.style.display = 'none';
    }
    // 3. reader completato ora mostra l'immagine
    reader.onload = function(e) {
      imagePreview.src = e.target.result;
      imagePreview.style.display = 'block';

      if (imagePreview.style.display === 'block') {
        document.getElementById('remove-image-button').style.display = 'block';
      }
    }
  }
  /**
   * Funzione per rimuovere l'immagine copertina
   */
  document.getElementById('remove-image-button').addEventListener('click', function() {
    event.preventDefault();
    document.getElementById('image-preview').src = '';
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('remove-image-button').style.display = 'none';
  });
  /**
   * Funzione per resetare l'immagine copertina
   * sembra ridondante ma l'ho aggiunto perche altrimenti se io apro esplorarisorse per caricare immagine e poi rimane a caso
   */
  function resetFileInput() {
    document.getElementById('cover_image').value = '';
    document.getElementById('image-preview').src = '';
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('remove-image-button').style.display = 'none';
  }

  let files = [];
  /**
   * Funzione per vedere le immagini non copertina
   */
  function previewListImage(event) {
    // container dove vengono mostrate le immagini
    const imageListPreviewContainer = document.getElementById('image-list-preview-container');

    // aggiungi i file all'array files
    const newFiles = Array.from(event.target.files); // converti FileList in array
    files.push(...newFiles); // Aggiungi i nuovi file all'array files
    console.log(files);

    imageListPreviewContainer.innerHTML = '';


    // iteriamo su ogni file del fileList
    files.forEach(file => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function(e) {
        console.log('singolo file', file);


        const imagePreview = document.createElement('img');
        imagePreview.src = e.target.result;
        imagePreview.classList.add('w-1/2', 'h-auto');
        imageListPreviewContainer.appendChild(imagePreview);
      };
    });
    event.target.value = '';
  }

  /**
   * Funzione per vedere le immagini non copertina
   */





</script>
@endsection
