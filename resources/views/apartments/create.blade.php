@extends('dashboard')

@section('header', 'Crea appartamento')
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
    <form action="{{ route('apartments.store') }}" enctype="multipart/form-data" method="POST" onsubmit="return validateForm()">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Colonna Sinistra: Servizi e Sponsorizzazioni -->
            <div class="col-span-1">
              <div id="services-error" class="hidden bg-red-100 text-red-700 p-2 rounded-md mb-2">
                        Seleziona almeno un servizio.
                    </div>
                <fieldset class="border border-gray-300 rounded-lg p-4 mb-4">
                    <legend class="text-sm font-medium text-gray-700">Servizi</legend>
                    <div class="space-y-2">
                        @foreach ($services as $service)
                            <div class="flex items-center">
                                <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                                <label for="service_{{ $service->id }}" class="ml-2 text-sm font-medium text-gray-700">
                                    <i class="{{ getServiceIcon($service->name) }} text-gray-700 mr-2 w-4"></i>
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>

            <!-- Colonna Destra: Dettagli Appartamento -->
            <div class="col-span-2">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Titolo -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Inserisci il titolo dell'appartamento"
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
                                value="{{ old('rooms') }}"
                                placeholder="Inserisci il numero di stanze"
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
                                value="{{ old('beds') }}"
                                placeholder="Inserisci il numero di letti"
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
                                value="{{ old('bathrooms') }}"
                                placeholder="Inserisci il numero di bagni"
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
                            value="{{ old('square_meters', 75) }}"
                            class="mt-1 w-full"
                            oninput="this.nextElementSibling.value = this.value"
                        />
                        <output>{{ old('square_meters', 75) }}</output> m²
                    </div>

                    <!-- Indirizzo -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Indirizzo</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ old('address') }}"
                            placeholder="Inserisci l'indirizzo"
                            class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                            required
                        />
                        <div id="suggestions" class="absolute bg-white border border-gray-300 rounded-md mt-1 z-10 hidden"></div>
                    </div>

                    <div class="justify-between">
                        <!-- Immagine Copertina -->
                        <div class="w-1/2 pr-2"> <!-- 50% di larghezza e padding a destra -->
                            <!-- Messaggio di errore per l'immagine di copertina -->
                            <div id="cover-image-error" class="hidden bg-red-100 text-red-700 p-2 rounded-md mb-4">
                                Carica un'immagine di copertina.
                            </div>

                            <label for="cover_image" class="block text-sm font-medium text-gray-700">Carica Immagine di copertina (Upload)</label>
                            <input
                                type="file"
                                id="cover_image"
                                name="cover_image"
                                accept="image/*"
                                class="hidden"
                                onchange="previewImage(event)"
                            />
                            <label for="cover_image" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500 cursor-pointer">
                                Seleziona immagine
                            </label>
                            <div>
                                <img id="image-preview" alt="Immagine Copertina" class="w-full h-auto mt-2" style="display: none;">
                                <button id="remove-image-button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" style="display: none;" onclick="resetFileInput()">Rimuovi Immagine</button>
                            </div>
                        </div>

                          <!-- carica altre immagini non copertina -->
                        <div id="image-group-container">
                          <div class="flex justify-between items-center mb-2">
                              <label class="block text-sm font-medium text-gray-700">Carica altre immagini (Upload)</label>
                              <button id="add-row-add-image-input" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Aggiungi riga</button>
                          </div>
                          <div class="row-image-group-container flex items-center mb-2">
                            <img class="w-48 h-32 object-cover rounded-lg border-4 border-blue-300" id="image-preview-group" alt="Anteprima immagine" style="display: none;">

                            <div class="flex-1 space-y-3">
                                <input
                                    type="file"
                                    name="images[]"
                                    class="image-group-input w-full border-blue-300 rounded-lg shadow-lg focus:border-blue-500 focus:ring-blue-500"
                                    onchange="previewImageNonCover(event)"
                                >
                                <img class="w-48 h-32 object-cover rounded-lg border-4 border-blue-300 mt-2" id="image-preview-group" alt="Anteprima immagine" style="display: none;">
                                <input
                                    type="text"
                                    name="image_description[]"
                                    class="w-full max-w-xs border-blue-300 rounded-lg shadow-lg focus:border-blue-500 focus:ring-blue-500 mt-2"
                                    placeholder="Descrizione dell'immagine"
                                >
                            </div>
                        </div>
                      </div>


                    <!-- Visibilità -->
                    <div class="flex items-center">
                        <input type="hidden" name="is_visible" value="0">
                        <input type="checkbox" name="is_visible" id="is_visible" value="1" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200" {{ old('is_visible', 1) ? 'checked' : '' }}>
                        <label for="is_visible" class="ml-2 text-sm font-medium text-gray-700">Visibile</label>
                    </div>

                    <!-- Descrizione -->
                    <div class="col-span-full">
                        <label for="description" class="block text-lg font-semibold text-gray-900">Descrizione</label>
                        <div class="mt-2">
                            <textarea
                                id="description"
                                name="description"
                                placeholder="Scrivi qui la descrizione dell'appartamento..."
                                class="p-4 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500 h-32 resize-none"
                                required
                            >{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Pulsante Submit -->
                    <div class="text-center">
                        <button
                            id="submit-button"
                            type="submit"
                            class="bg-yellow-500 text-white font-medium px-6 py-2 rounded-md shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                        >
                            Crea Appartamento
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<script>


  document.getElementById('address').addEventListener('input', async function() {
    const apiTomTomKey = "{{ env('API_TOMTOM_KEY') }}";
    const inputValue = this.value;
    const url = "https://api.tomtom.com/search/2/geocode/" + encodeURIComponent(inputValue) + ".json?key=" + apiTomTomKey + "&limit=5&countrySet=IT&language=it-IT";

    if (inputValue.length < 3) {
        document.getElementById('suggestions').innerHTML = '';
        document.getElementById('suggestions').classList.add('hidden');
        document.getElementById('address').classList.add('border-red-500');
        return;
    }

      const response = await fetch(url);
    const data = await response.json();


    const suggestions = data['results'] || [];
    const suggestionsContainer = document.getElementById('suggestions');
    suggestionsContainer.innerHTML = '';

    suggestions.forEach(result => {
        const address = result['address']['freeformAddress'];
        const suggestionItem = document.createElement('div');
        suggestionItem.textContent = address;
        suggestionItem.classList.add('p-2', 'cursor-pointer');

        suggestionItem.addEventListener('click', function() {
            document.getElementById('address').value = address;
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.classList.add('hidden');
        });

        suggestionsContainer.appendChild(suggestionItem);
    });

    if (suggestions.length > 0) {
        suggestionsContainer.classList.remove('hidden');
    } else {
        suggestionsContainer.classList.add('hidden');
    }


  });




  document.addEventListener('click', function(event) {
    const suggestionsContainer = document.getElementById('suggestions');
    if (!suggestionsContainer.contains(event.target) && event.target.id !== 'address') {
        suggestionsContainer.innerHTML = '';
        suggestionsContainer.classList.add('hidden');
    }
  });

  /**
   * Funzione per vedere l'immagine copertina
   */
  function previewImage(event) {
    // 1. init globale reader per leggere le immagini
    const reader = new FileReader();
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

  // FUNZIONI PER GESTIRE LE IMMAGINI NON COPERTINA
  /**
   * Funzione per aggiungere una riga
   */
  document.getElementById('add-row-add-image-input').addEventListener('click', function(event) {
    event.preventDefault();
    const imageGroupContainer = document.querySelector('#image-group-container');
    const newRowHTML = `
        <div class="row-image-group-container flex">
          <img class="w-48" id="image-preview-group" alt="Immagine Copertina" style="display: none;">
                        <div class="flex-1 space-y-3">
        <input
            type="file"
            name="images[]"
            class="image-group-input w-full border-blue-300 rounded-lg shadow-lg focus:border-blue-500 focus:ring-blue-500"
            onchange="previewImageNonCover(event)"
        >
        <img class="w-48 h-32 object-cover rounded-lg border-4 border-blue-300 mt-2" id="image-preview-group" alt="Anteprima immagine" style="display: none;">
        <div class="flex items-center">
            <input
                type="text"
                name="image_description[]"
                class="w-full max-w-xs border-blue-300 rounded-lg shadow-lg focus:border-blue-500 focus:ring-blue-500 mt-2"
                placeholder="Descrizione dell'immagine"
            >
            <button class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 delete-row">
                Elimina
            </button>
        </div>
    `;
    imageGroupContainer.insertAdjacentHTML('beforeend', newRowHTML);
});

/**
 * Funzione per mostrare l'immagine
 */
function previewImageNonCover(event) {
    // 1. prendi l'input file
    const fileInput = event.target;

    // 2. crea un reader
    const reader = new FileReader();

    // 3. leggi l'immagine
    reader.readAsDataURL(fileInput.files[0]);
    reader.onload = function(e) {
        // 4. trova il contenitore genitore e l'immagine corrispondente
        const rowContainer = fileInput.closest('.row-image-group-container');
        const imagePreview = rowContainer.querySelector('img');

        // 5. imposta l'URL dell'immagine
        imagePreview.src = e.target.result;
        // 6. rendi visibile l'immagine
        imagePreview.style.display = 'block';
    };
}

/**
 * Funzione per eliminare una riga
 */
document.getElementById('image-group-container').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-row')) {
        event.preventDefault();
        const rowToDelete = event.target.closest('.row-image-group-container');
        rowToDelete.remove();
    }
});

function validateForm() {
    const serviceCheckboxes = document.querySelectorAll('input[name="services[]"]');
    const coverImageInput = document.getElementById('cover_image');

    let isServiceChecked = false;
    let isSponsorshipChecked = false;

    serviceCheckboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            isServiceChecked = true;
        }
    });

    sponsorshipRadios.forEach((radio) => {
        if (radio.checked) {
            isSponsorshipChecked = true;
        }
    });

    const servicesErrorDiv = document.getElementById('services-error');
    const sponsorshipErrorDiv = document.getElementById('sponsorship-error');
    const coverImageErrorDiv = document.getElementById('cover-image-error');

    if (!isServiceChecked) {
        servicesErrorDiv.classList.remove('hidden');
    } else {
        servicesErrorDiv.classList.add('hidden');
    }

    if (!isSponsorshipChecked) {
        sponsorshipErrorDiv.classList.remove('hidden');
    } else {
        sponsorshipErrorDiv.classList.add('hidden');
    }

    // Controllo per l'immagine di copertina
    if (!coverImageInput.files.length) {
        coverImageErrorDiv.classList.remove('hidden');
        return false;
    } else {
        coverImageErrorDiv.classList.add('hidden');
    }

    return isServiceChecked && isSponsorshipChecked;
}
</script>
@endsection
@php
function getServiceIcon($serviceName) {
    switch ($serviceName) {
        case 'WiFi':
            return 'fas fa-wifi';
        case 'Parcheggio':
            return 'fas fa-parking';
        case 'Silver':
            return 'fas fa-medal';
        case 'Aria Condizionata':
            return 'fas fa-wind';
        case 'Cucina':
            return 'fas fa-utensils';
        case 'Lavatrice':
            return 'fas fa-tshirt';
        case 'TV':
            return 'fas fa-tv';
        case 'Riscaldamento':
            return 'fas fa-thermometer-half';
        default:
            return 'fas fa-check-circle';
    }
}
@endphp
