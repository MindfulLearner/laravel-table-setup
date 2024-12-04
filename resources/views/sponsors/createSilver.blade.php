@extends('dashboard')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 py-12 px-4">
    <div class="max-w-5xl mx-auto grid grid-cols-1 gap-8">
        
        <!-- Card Dettagli Appartamenti -->
        <div class="bg-neutral-800 p-8 rounded-3xl shadow-xl">
            <h2 class="text-3xl font-extrabold text-gray-100 mb-6 text-center border-b-4 border-yellow-700 pb-4">Dettagli Appartamenti</h2>
            <ul class="mb-6">
                @foreach($selectedApartments as $apartment)
                    <li class="text-lg text-white mb-2">
                        <strong>{{ $apartment->title }}</strong> - Prezzo: {{ number_format($totalPrice, 2) }} €
                    </li>
                @endforeach
            </ul>
            <p class="text-2xl font-bold text-white">Piano: Silver</p>
            <p class="text-2xl font-bold text-white mt-4">Prezzo Totale: <span id="totalPrice">{{ number_format($totalPrice, 2) }} €</span></p>
        </div>

        <!-- Card Pagamento -->
        <div class="bg-neutral-800 p-8 rounded-3xl shadow-xl">
            <h2 class="text-3xl font-extrabold text-gray-100 mb-6 text-center border-b-4 border-yellow-700 pb-4">Pagamento</h2>
            <form action="{{ route('updateSponsorSilver') }}" method="POST" id="payment-form">
                @csrf
                <div id="dropin-container" class="mb-6"></div>
                <input type="hidden" id="nonce" name="payment_method_nonce">
                <button type="submit" id="submit-button" class="w-full px-8 py-4 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white rounded-full shadow-lg hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-400 transition-all ease-in-out duration-300 transform hover:scale-105 h-14 opacity-100">
                    Attiva Piano Silver
                </button>
            </form>
            <p class="mt-6 text-sm text-gray-400">
                Inviando questo ordine autorizzi il nostro servizio a eseguire l'addebito dell'importo di € {{ number_format($totalPrice, 2) }} per un periodo di prova di 3 mesi. Se non recedi prima della scadenza dell'anzidetto periodo di prova, autorizzi il nostro servizio a eseguire automaticamente addebiti mensili di € {{ number_format($totalPrice, 2) }} ciascuno fino alla disdetta del tuo abbonamento. Se la tariffa dovesse cambiare, te ne daremo preventiva comunicazione scritta. In qualsiasi momento puoi verificare
            </p>
        </div>
    </div>
</div>

<style>
    .hover\:glow:hover {
        box-shadow: 0px 0px 10px 5px rgba(0, 77, 77, 0.4);
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
