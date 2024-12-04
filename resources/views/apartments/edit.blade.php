@extends('dashboard')

@section('header', 'Aggiorna appartamento')

@section('content')
{{-- form per editare un appartamento --}}

<div class="max-w-4xl mx-auto bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 shadow-xl rounded-lg p-10 mt-10">

    @if ($errors->any())
        <div class="bg-red-200 text-red-900 p-5 rounded-lg mb-6 shadow-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-3xl font-extrabold text-gray-200 mb-8 text-center border-b-4 border-yellow-500 pb-4">
        Aggiorna Appartamento
    </h1>

    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Colonna Sinistra: Servizi -->
            <div class="col-span-1">
                <fieldset class="border border-gray-500 rounded-xl p-6 mb-8 shadow-lg">
                    <legend class="text-md font-bold text-gray-100">Servizi</legend>
                    <div class="space-y-3 mt-4">
                        @foreach ($services as $service)
                            <div class="flex items-center">
                                <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}" class="mr-3 h-5 w-5 text-yellow-500 bg-black border-gray-300 rounded focus:ring focus:ring-yellow-300 focus:ring-opacity-50" @if($apartment->services->contains($service->id)) checked @endif>
                                <label for="service_{{ $service->id }}" class="ml-2 text-md font-medium text-gray-200 flex items-center">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2"></i>
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>

            <!-- Colonna Destra: Dettagli Appartamento -->
            <div class="col-span-2">
                <div class="grid grid-cols-1 gap-8">

                    <!-- Titolo -->
                    <div>
                        <label for="title" class="block text-md font-semibold text-gray-100">Titolo</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $apartment->title) }}"
                            placeholder="Inserisci un titolo..."
                            class="p-4 mt-2 block w-full bg-black text-gray-200 border-gray-500 rounded-lg shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition"
                            required
                        />
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <!-- Stanze -->
                        <div>
                            <label for="rooms" class="block text-md font-semibold text-gray-100">Stanze</label>
                            <input
                                type="number"
                                id="rooms"
                                name="rooms"
                                value="{{ old('rooms', $apartment->rooms) }}"
                                placeholder="Inserisci il numero di stanze..."
                                class="p-4 mt-2 block w-full bg-black text-gray-200 border-gray-500 rounded-lg shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition"
                                required
                            />
                        </div>

                        <!-- Letti -->
                        <div>
                            <label for="beds" class="block text-md font-semibold text-gray-100">Letti</label>
                            <input
                                type="number"
                                id="beds"
                                name="beds"
                                value="{{ old('beds', $apartment->beds) }}"
                                placeholder="Inserisci il numero di letti..."
                                class="p-4 mt-2 block w-full bg-black text-gray-200 border-gray-500 rounded-lg shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition"
                                required
                            />
                        </div>

                        <!-- Bagni -->
                        <div>
                            <label for="bathrooms" class="block text-md font-semibold text-gray-100">Bagni</label>
                            <input
                                type="number"
                                id="bathrooms"
                                name="bathrooms"
                                value="{{ old('bathrooms', $apartment->bathrooms) }}"
                                placeholder="Inserisci il numero di bagni..."
                                class="p-4 mt-2 block w-full bg-black text-gray-200 border-gray-500 rounded-lg shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition"
                                required
                            />
                        </div>
                    </div>

                    <!-- Metri Quadri con linea trascinabile -->
                    <div class="flex items-center gap-4 mt-4">
                        <input
                            type="range"
                            id="square_meters"
                            name="square_meters"
                            min="20"
                            max="200"
                            value="{{ old('square_meters', $apartment->square_meters) }}"
                            class="w-full range-slider"
                            oninput="updateRangeProgress(this); this.nextElementSibling.querySelector('span').innerText = this.value"
                        />
                        <output class="bg-gray-800 text-yellow-500 font-semibold w-3/12 text-center text-lg rounded-md px-4 py-2 shadow-md">
                            <span>{{ old('square_meters', $apartment->square_meters) }}</span> m²
                        </output>
                    </div>

                    <!-- Indirizzo -->
                    <div>
                        <label for="address" class="block text-md font-semibold text-gray-100">Indirizzo</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ old('address', $apartment->address) }}"
                            class="p-4 mt-2 block w-full bg-black text-gray-200 border-gray-500 rounded-lg shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition"
                            required
                        />
                        <div id="suggestions" class="absolute bg-black border border-gray-500 rounded-lg mt-1 z-10 hidden text-gray-200"></div>
                    </div>

                    <!-- Immagine copertina -->
                    <div>
                        <label for="cover_image" class="block text-md font-semibold text-gray-100">Immagine di copertina</label>
                        <!-- Immagine corrente -->
                        <img id="current-cover" src="{{ $apartment->cover_image }}" alt="Immagine Copertina" class="w-full h-64 object-cover mb-4 rounded-lg border-4 border-yellow-500" />
                        <!-- Upload nuova immagine -->
                        <input
                            type="file"
                            id="cover_image"
                            name="cover_image"
                            accept="image/*"
                            class="hidden"
                            onchange="previewImage(event)"
                        />
                        <label for="cover_image" class="p-4 mt-2 block w-full border-2 border-dashed border-gray-500 rounded-lg text-center cursor-pointer text-gray-400 hover:bg-gray-700 transition">
                            Cambia immagine
                        </label>

                        <!-- Preview nuova immagine -->
                        <img id="image-preview" alt="Anteprima nuova immagine" class="w-full h-64 object-cover mt-4 rounded-lg border-4 border-yellow-500" style="display: none;">

                        <!-- Pulsante rimuovi -->
                        <button id="remove-image-button" class="mt-2 bg-red-500 text-white px-5 py-2 rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition" style="display: none;">
                            Annulla modifica
                        </button>
                    </div>

                    <!-- Immagini non copertina -->
                    <div class="space-y-8">
                        <label class="block text-lg font-bold text-yellow-500 mb-4">Le tue immagini caricate</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($images as $image)
                                <div class="bg-neutral-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                                    <div class="relative">
                                        <img
                                            src="{{ $image->image_path }}"
                                            alt="Immagine appartamento"
                                            class="w-full h-32 object-cover transition duration-300 ease-in-out"
                                        />
                                        <!-- Bottone per eliminare l'immagine -->
                                        <button type="button" class="absolute top-2 right-2 bg-red-600 text-white px-3 py-1 rounded-full shadow-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition" onclick="deleteImage({{ $image->id }})">
                                            Elimina
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <p class="text-sm text-gray-400 italic">{{ $image->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Carica nuove immagini -->
                    <div id="image-group-container" class="mt-10">
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-md font-semibold text-gray-100">Aggiungi nuove immagini</label>
                            <button id="add-row-add-image-input" class="bg-[#967305] text-white px-4 py-2 rounded-lg shadow hover:bg-white hover:text-[#967305] focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all ease-in-out duration-300 focus:ring-offset-2">
                                Aggiungi altra immagine
                            </button>
                        </div>
                        <div class="row-image-group-container flex items-center mb-2">
                            <img class="w-48 h-32 object-cover rounded-lg border-4 border-blue-300" id="image-preview-group" alt="Anteprima immagine" style="display: none;">
                            <div class="flex-1 space-y-3">
                                <input
                                    type="file"
                                    name="images[]"
                                    class="image-group-input w-full bg-black text-gray-200 border-blue-500 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 transition"
                                    onchange="previewImageNonCover(event)"
                                >
                                <input
                                    type="text"
                                    name="image_description[]"
                                    class="w-full max-w-xs bg-black text-gray-200 border-blue-500 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 mt-2"
                                    placeholder="Descrizione dell'immagine"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Visibilità -->
                    <div class="flex items-center mt-6">
                        <input type="hidden" name="is_visible" value="0">
                        <input type="checkbox" name="is_visible" id="is_visible" value="1" class="mr-3 h-5 w-5 text-yellow-500 border-gray-500 bg-black rounded focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition" {{ old('is_visible', $apartment->is_visible) ? 'checked' : '' }}>
                        <label for="is_visible" class="text-md font-semibold text-gray-100">Visibile</label>
                    </div>

                    <!-- Pulsante Submit -->
                    <div class="text-center mt-10">
                        <button
                            type="submit"
                            class="bg-[#967305] text-white font-bold px-10 py-4 rounded-full shadow-lg hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-400 focus:ring-opacity-50 transition transform hover:scale-105"
                        >
                            Aggiorna Appartamento
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-700 text-yellow-100 rounded-lg">
            <p>{{ session('success') }}</p>
        </div>
    @endif
</div>

<style>
    .range-slider {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 8px;
        background: #444;
        border-radius: 4px;
        position: relative;
        outline: none;
    }

    /* Thumb personalizzato per Safari */
    .range-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 24px;
        height: 24px;
        margin-top: -8px;
        background: #FFD700;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #FFD700;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease-in-out;
        position: relative;
        z-index: 2;
    }

    /* Thumb personalizzato per Firefox */
    .range-slider::-moz-range-thumb {
        width: 24px;
        height: 24px;
        background: #FFD700;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #FFD700;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease-in-out;
        position: relative;
        z-index: 2;
    }

    /* Track per il colore di avanzamento */
    .range-slider::-webkit-slider-runnable-track {
        width: 100%;
        height: 8px;
        background: linear-gradient(to right, #FFD700 var(--value), #444 var(--value));
        border-radius: 4px;
        position: relative;
        z-index: 1;
    }

    /* Track per il colore di avanzamento in Firefox */
    .range-slider::-moz-range-progress {
        background: #FFD700;
        height: 8px;
        border-radius: 4px;
    }

    .range-slider::-moz-range-track {
        background: #444; /* Colore della parte non avanzata */
        height: 8px;
        border-radius: 4px;
    }

    .range-slider::-webkit-slider-thumb:hover,
    .range-slider::-moz-range-thumb:hover {
        transform: scale(1.2); /* Effetto hover per ingrandire il thumb */
    }
</style>

<script>
    function updateRangeProgress(range) {
        const value = ((range.value - range.min) / (range.max - range.min)) * 100;
        range.style.background = `linear-gradient(to right, #FFD700 ${value}%, #444 ${value}%)`;
    }

    // Esegui la funzione al caricamento della pagina per impostare correttamente la barra iniziale
    document.addEventListener('DOMContentLoaded', function() {
        const rangeInput = document.getElementById('square_meters');
        updateRangeProgress(rangeInput);
    });

    /**
     * Funzione per suggerire l'indirizzo
     */
  document.getElementById('address').addEventListener('input', async function() {
    const apiTomTomKey = "{{ env('API_TOMTOM_KEY') }}";
    const inputValue = this.value;
    const url = "https://api.tomtom.com/search/2/geocode/" + encodeURIComponent(inputValue) + ".json?key=" + apiTomTomKey + "&limit=5&countrySet=IT&language=it-IT";

    if (inputValue.length < 3) {
        document.getElementById('suggestions').innerHTML = '';
        document.getElementById('suggestions').classList.add('hidden');
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



 // FUNZIONI PER GESTIRE LE IMMAGINI NON COPERTINA
  /**
   * Funzione per aggiungere una riga
   */
   document.getElementById('add-row-add-image-input').addEventListener('click', function(event) {
    event.preventDefault();

    const imageGroupContainer = document.querySelector('#image-group-container');
    const newRowHTML = `
        <div class="row-image-group-container flex">
            <img class="w-48" alt="Immagine Copertina" style="display: none;">
            <div class="flex-1 space-y-3">
            <input
                type="file"
                name="images[]"
                class="image-group-input w-full border-blue-300 rounded-lg shadow-lg focus:border-blue-500 focus:ring-blue-500"
                onchange="previewImageNonCover(event)"
            >
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
 * Funzione per eliminare una riga
 */
document.getElementById('image-group-container').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-row')) {
        event.preventDefault();
        const rowToDelete = event.target.closest('.row-image-group-container');
        rowToDelete.remove();
    }
});

/**
 * Funzione per il popup di eliminazione
 */
function deleteImage(imageId) {
    Swal.fire({
        title: 'Sei sicuro?',
        text: "Non potrai recuperare questa immagine!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sì, elimina!',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/images/${imageId}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

  </script>
@endsection
