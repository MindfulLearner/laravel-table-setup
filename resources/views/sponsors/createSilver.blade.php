@extends('dashboard')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 py-12 px-4">
    <div class="max-w-5xl mx-auto bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 p-10 rounded-3xl shadow-xl">
        <h2 class="text-4xl font-extrabold text-gray-100 mb-8 text-center border-b-4 border-gray-300 pb-4">Seleziona Appartamenti per il Piano Silver</h2>
        <form id="payment-form" action="{{ route('updateSponsorSilver') }}" method="POST">

            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- Foreach degli appartamenti -->
                @foreach($apartments as $apartment)
                    <div id="card-{{ $apartment->id }}" class="apartment-card hover:glow relative rounded-xl shadow-lg bg-neutral-800 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                        <img src="{{ $apartment->cover_image }}" alt="Property Image" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-300 mb-4">{{ $apartment->title }}</h3>
                            <p class="text-gray-300 mb-4">{{ Str::limit($apartment->description, 100, '...') }}</p>
                            <p class="text-gray-400 font-bold text-lg">Prezzo: 5,99 €</p>
                            
                            <div class="flex items-center mt-6">
                                <input type="checkbox" name="apartments[]" value="{{ $apartment->id }}" id="apartment-{{ $apartment->id }}" class="mr-3 h-5 w-5 text-yellow-500 border-gray-500 bg-neutral-700 rounded focus:ring focus:ring-gray-300 focus:ring-opacity-50 transition" onchange="toggleCardSelection({{ $apartment->id }})">
                                <label for="apartment-{{ $apartment->id }}" class="text-lg font-semibold text-gray-100">Seleziona</label>
                            </div>
    
                            <!-- Sponsorizzazione Attiva/Inattiva -->
                            @if($apartment->sponsorships->where('name', 'Silver')->first())
                                <p class="mt-4 text-sm font-bold text-green-400">Stato: Attivo</p>
                            @else
                                <p class="mt-4 text-sm font-bold text-red-500">Stato: Inattivo</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                <!-- Fine del foreach -->
            </div>
            
            <div class="flex justify-between items-center mt-8">
                <p class="text-2xl font-bold text-white">Prezzo Totale: <span id="totalPrice">0,00 €</span></p>
                <div id="dropin-container"></div>
                <input type="hidden" id="nonce" name="payment_method_nonce">
                <button type="submit" id="submit-button" class="px-8 py-4 bg-gradient-to-t from-gray-300 to-gray-500 text-white rounded-full shadow-lg hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all ease-in-out duration-300 transform hover:scale-105 h-14 opacity-100">
                    Attiva Piano Silver
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .hover\:glow:hover {
        box-shadow: 0px 0px 10px 5px rgba(0, 77, 77, 0.4);
    }

    .selected-card {
        background: linear-gradient(to bottom right, #4B5563, #FFFFFF); /* Gradient from gray-800 to white */
        box-shadow: 0 0 15px rgba(148, 163, 184, 0.6);
        transition: background 0.5s ease, box-shadow 0.5s ease; /* Smooth transition */
    }
</style>
<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
<script>
    function toggleCardSelection(apartmentId) {
        const card = document.getElementById(`card-${apartmentId}`);
        const checkbox = document.getElementById(`apartment-${apartmentId}`);

        if (checkbox.checked) {
            card.classList.add('selected-card');
        } else {
            card.classList.remove('selected-card');
        }

        calculateTotal(); // Update the total price whenever a card is selected/deselected
    }

    function calculateTotal() {
        const checkboxes = document.querySelectorAll('input[name="apartments[]"]:checked');
        const totalPriceElement = document.getElementById('totalPrice');
        const pricePerApartment = 5.99;
        let total = checkboxes.length * pricePerApartment;
        totalPriceElement.textContent = total.toFixed(2) + ' €';
    }


        fetch('/payment/token')
            .then(response => response.json())
            .then(data => {
                braintree.dropin.create({
                    authorization: data.token,
                    container: '#dropin-container'
                }, function (createErr, instance) {
                    if (createErr) {
                        console.error('Errore nella creazione del Drop-in:', createErr);
                        return;
                    }
                    document.getElementById('submit-button').addEventListener('click', function () {
                        instance.requestPaymentMethod(function (err, payload) {
                            if (err) {
                                console.error(err);
                                return;
                            }
                            document.getElementById('nonce').value = payload.nonce;
                            document.getElementById('payment-form').submit();
                        });
                    });
                });
            });
    </script>
</div>

@endsection
