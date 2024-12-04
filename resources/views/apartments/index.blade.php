@extends('dashboard')

@section('header', 'Gestione appartamenti')

@section('content')
@if (session('error'))
    <div class="alert alert-danger bg-red-500 text-white font-semibold py-3 px-5 rounded-lg mb-6">
        {{ session('error') }}
    </div>
@endif
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-black via-[#013E49] to-black overflow-hidden shadow-lg sm:rounded-lg p-6">
            <div class="text-yellow-500 text-3xl font-bold border-b-4 border-yellow-500 pb-4 mb-6">
                {{ __("Accesso eseguito!") }}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
              @foreach ($apartments as $apartment)
              <div class="w-full mx-auto bg-neutral-900 shadow-lg rounded-2xl overflow-hidden transform transition-all ease-in-out duration-500 cursor-pointer hover:scale-105 hover:shadow-2xl relative group">
                  <div class="absolute inset-0 bg-gradient-to-r from-[#013E49] to-[#004D73] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out rounded-2xl"></div>
                  <div class="relative">
                      <div class="relative">
                          <img src="{{ $apartment->cover_image }}" alt="Property Image" class="w-full h-56 object-cover rounded-t-2xl">
                          <div class="absolute inset-0 bg-black opacity-20 hover:opacity-0 transition-all ease-in-out duration-300 rounded-t-2xl"></div>
                      </div>
                      <div class="p-6">
                        <h2 class="text-3xl font-bold text-yellow-500 mb-3">{{ $apartment->title }}</h2>
                        <div class="flex items-center text-gray-300 text-sm mb-4 space-x-6">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-door-open text-yellow-500"></i>
                                <span><strong>Stanze:</strong> {{ $apartment->rooms }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-bed text-yellow-500"></i>
                                <span><strong>Letti:</strong> {{ $apartment->beds }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-bath text-yellow-500"></i>
                                <span><strong>Bagni:</strong> {{ $apartment->bathrooms }}</span>
                            </div>
                        </div>
                        <div class="text-gray-300 text-sm space-y-3">
                            <p><i class="fas fa-ruler text-yellow-500"></i> <strong>Metri Quadri:</strong> {{ $apartment->square_meters }} m²</p>
                            <p><i class="fas fa-map-marker-alt text-yellow-500"></i> <strong>Indirizzo:</strong> {{ $apartment->address }}</p>
                            <p><i class="fas fa-map-marked-alt text-yellow-500"></i> <strong>Coordinate:</strong> {{ $apartment->latitude }}, {{ $apartment->longitude }}</p>
                            <p><i class="fas fa-concierge-bell text-yellow-500"></i> <strong>Servizi:</strong>
                                <span class="text-yellow-500 font-semibold">
                                    @foreach ($apartment->services->sortBy('id') as $service)
                                        {{ $service->name }}@if (!$loop->last), @endif
                                    @endforeach
                                </span>
                            </p>
                        </div>
                        <div class="mt-6 flex justify-between items-center">
                            @if ($apartment->user_id === $superId)
                                <a href="{{ route('apartments.edit', $apartment->id) }}" class="border-2 border-yellow-400 bg-transparent text-white px-5 py-3 rounded-full font-semibold hover:bg-yellow-500 transition-all ease-in-out duration-500">
                                    Modifica
                                </a>
  
                                <button class="open-modal border-2 border-red-600 bg-transparent text-white px-5 py-3 rounded-full font-semibold hover:bg-red-900 transition-all ease-in-out duration-500" data-apartment-id="{{ $apartment->id }}">
                                    Cancella
                                </button>
  
                                <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <div id="modal-container-{{ $apartment->id }}" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 p-4 z-50">
                                        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-md w-full text-white">
                                            <p class="mb-6 text-lg font-semibold text-yellow-500">Sei sicuro di voler cancellare l'appartamento "{{ $apartment->title }}"?</p>
                                            <div class="flex justify-end space-x-4">
                                                <button type="button" class="close-modal bg-gray-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">Chiudi</button>
                                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-300">Cancella</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <a href="{{ route('apartments.show', $apartment->id) }}" class="bg-transparent border-2 border-green-600 text-white px-5 py-3 rounded-full ease-in-out font-semibold hover:bg-green-700 transition duration-500">
                                Vedi
                            </a>

                        </div>
                      </div>
                  </div>
              </div>

          @endforeach
          
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
                            const modalContainer = button.closest(".fixed");
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
