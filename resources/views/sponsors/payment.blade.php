@extends('dashboard')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 py-12 px-4">
    <div class="max-w-5xl mx-auto grid grid-cols-1 gap-8">

        <!-- Card Dettagli Appartamenti -->
        <div class="bg-neutral-800 p-8 rounded-3xl shadow-xl">
            <h2 class="text-3xl font-extrabold text-gray-100 mb-6 text-center border-b-4 border-{{ $sponsorshipType === 'Bronze' ? 'yellow-700' : ($sponsorshipType === 'Silver' ? 'gray-400' : 'yellow-600') }} pb-4">
                Dettagli Appartamenti
            </h2>
            <ul class="mb-6">
                @foreach($selectedApartments as $apartment)
                    <li class="text-lg text-white mb-2">
                        <strong>{{ $apartment->title }}</strong> - Prezzo:
                        @switch($sponsorshipType)
                            @case('Bronze')
                                2,99 €
                                @break
                            @case('Silver')
                                5,99 €
                                @break
                            @case('Gold')
                                9,99 €
                                @break
                        @endswitch
                    </li>
                @endforeach
            </ul>
            <p class="text-2xl font-bold text-white">Piano: {{ $sponsorshipType }}</p>
            <p class="text-2xl font-bold text-white mt-4">Prezzo Totale: <span id="totalPrice">{{ number_format($totalPrice, 2) }} €</span></p>
        </div>

        <!-- Card Pagamento -->
        <div class="bg-neutral-800 p-8 rounded-3xl shadow-xl">
            <h2 class="text-3xl font-extrabold text-gray-100 mb-6 text-center border-b-4 border-{{ $sponsorshipType === 'Bronze' ? 'yellow-700' : ($sponsorshipType === 'Silver' ? 'gray-400' : 'yellow-600') }} pb-4">Pagamento</h2>
            <form action="{{ route('updateSponsor' . $sponsorshipType) }}" method="POST" id="payment-form">
                @csrf
                @foreach($selectedApartments as $apartment)
                    <input type="hidden" name="apartments[]" value="{{ $apartment->id }}">
                @endforeach
                <input type="hidden" name="amount" value="{{ $totalPrice }}">
                <div id="dropin-container" class="mb-6"></div>
                <input type="hidden" id="nonce" name="payment_method_nonce">

                <button type="submit" id="submit-button" disabled
                    class="w-full px-8 py-4 bg-gradient-to-t from-{{ $sponsorshipType === 'Bronze' ? 'yellow-600 to-yellow-800' : ($sponsorshipType === 'Silver' ? 'gray-600 to-gray-800' : 'yellow-600 to-yellow-800') }} text-white rounded-full shadow-lg hover:bg-{{ $sponsorshipType === 'Bronze' ? 'yellow-500' : ($sponsorshipType === 'Silver' ? 'gray-500' : 'yellow-500') }} focus:outline-none focus:ring-4 focus:ring-{{ $sponsorshipType === 'Bronze' ? 'yellow-400' : ($sponsorshipType === 'Silver' ? 'gray-400' : 'yellow-400') }} transition-all ease-in-out duration-300 transform hover:scale-105 h-14 opacity-50">
                    Attiva Piano {{ $sponsorshipType }}
                </button>
            </form>
        </div>

    </div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
<script>
    const submitButton = document.getElementById('submit-button');

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

                //  bilita il pulsante solo quando il dropin è stato creato
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50');
                submitButton.classList.add('opacity-100');

                submitButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    // disabilita il pulsante durante la richiesta del pagamento
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50');

                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.error(err);
                            // riabilita il pulsante in caso di errore
                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-50');
                            return;
                        }

                        document.getElementById('nonce').value = payload.nonce;

                        if (!payload.nonce) {
                            alert('Errore: il metodo di pagamento non è stato fornito.');
                            // Riabilita il pulsante in caso di errore
                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-50');
                            return;
                        }

                        document.getElementById('payment-form').submit();
                    });
                });
            });
        });
</script>
@endsection
