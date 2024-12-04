@extends('dashboard')

@section('header', 'Gestione appartamenti')

@section('content')
@if (session('error'))
    <div class="alert alert-danger -red-500">
        {{ session('error') }}
    </div>
@endif
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-red-200">
              {{ __("Accesso eseguito!") }}
              <a href="{{ route('apartments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                Crea Appartamento
              </a>

              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-3">
              @foreach ($apartments as $apartment)
              <div
              class="w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden transform transition-transform duration-300 cursor-pointer hover:scale-95"
              x-show="isVisible"
            >
              <img
                src="{{ $apartment->cover_image }}"
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
                  <p><strong>Servizi:</strong>
                      <span class="text-gray-700">
                          @foreach ($apartment->services->sortBy('id') as $service)
                              {{ $service->name }}@if (!$loop->last), @endif
                          @endforeach
                      </span>
                  </p>
                </div>
                <div class="mt-4 flex justify-between">
                  @if ($apartment->user_id === $superId)
                    <a href="{{ route('apartments.edit', $apartment->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                      Modifica
                    </a>

                      <button class="deleteButton bg-red-500 text-white px-4 py-2 rounded" data-id="{{ $apartment->id }}">
                        Cancella
                      </button>

                      <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                      <div id="modal-container-{{ $apartment->id }}" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg mx-auto">
                          <p class="mb-4">sei sicuro di voler cancellare l'appartamento {{ $apartment->title }}?</p>
                          <div class="flex justify-end">
                            <button type="button" class="close-modal bg-blue-500 text-white px-4 py-2 rounded mr-2">Chiudi</button>
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Cancella</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  @endif
                  <a href="{{ route('apartments.show', $apartment->id) }}" class="bg-green-500 text-white px-4 py-2 rounded">
                    Vedi
                  </a>
                </div>
              </div>
            </div>
              @endforeach
              
              <script>
                // Logica conferma cancellazione

                document.querySelectorAll(".deleteButton").forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        const apartmentId = this.getAttribute('data-id');
                        Swal.fire({
                            title: 'Sei sicuro?',
                            text: "Non potrai recuperare questo appartamento!",
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
                                form.action = `/apartments/${apartmentId}`;

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
                    });
                });

                document.addEventListener("DOMContentLoaded", () => {
                    document.querySelectorAll(".open-modal").forEach(button => {
                        button.addEventListener("click", () => {
                            const apartmentId = button.getAttribute("data-apartment-id");
                            const modalContainer = document.getElementById(`modal-container-${apartmentId}`);
                            if (modalContainer) {
                                modalContainer.classList.remove("hidden");
                            }
                        });
                    });

                    document.querySelectorAll(".close-modal").forEach(button => {
                        button.addEventListener("click", () => {
                            const modalContainer = button.closest(".bg-gray-500");
                            if (modalContainer) {
                                modalContainer.classList.add("hidden");
                            }
                        });
                    });
                });
            </script>
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
