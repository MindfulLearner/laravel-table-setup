@extends('dashboard')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 py-12 px-4">
    <div class="max-w-5xl mx-auto bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 p-10 rounded-3xl shadow-xl">
        <h2 class="text-4xl font-extrabold text-gray-100 mb-8 text-center border-b-4 border-yellow-600 pb-4">Seleziona Appartamenti per il Piano Gold</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            @foreach($apartments as $apartment)
                <div id="card-{{ $apartment->id }}" class="hover:glow relative rounded-xl shadow-lg bg-neutral-800 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                    <img src="{{ $apartment->cover_image }}" alt="Property Image" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-yellow-600 mb-4">{{ $apartment->title }}</h3>
                        <p class="text-gray-300 mb-4">{{ Str::limit($apartment->description, 100, '...') }}</p>
                        <p class="text-yellow-600 font-bold text-lg">Prezzo: 9,99 €</p>

                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="apartments[]" value="{{ $apartment->id }}" id="apartment-{{ $apartment->id }}" class="mr-3 h-5 w-5 text-yellow-600 border-gray-500 bg-neutral-700 rounded focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition" onchange="calculateTotal()">
                            <label for="apartment-{{ $apartment->id }}" class="text-lg font-semibold text-gray-100">Seleziona</label>
                        </div>

                        @if($apartment->sponsorships->where('name', 'Gold')->first())
                            <p class="mt-4 text-sm font-bold text-green-400">Stato: Attivo</p>
                        @else
                            <p class="mt-4 text-sm font-bold text-red-500">Stato: Inattivo</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-between items-center mt-8">
            <p class="text-2xl font-bold text-white">Prezzo Totale: <span id="totalPrice">0,00 €</span></p>
            <div class="flex flex-col items-end gap-2">
                <p id="alertMessage" class="text-red-500 text-sm">
                    Seleziona almeno un appartamento
                </p>
                <button type="button" onclick="proceedToPayment()" id="proceedButton" disabled
                    class="px-8 py-4 bg-gradient-to-t from-yellow-600 to-yellow-800 text-white rounded-full shadow-lg hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-400 transition-all ease-in-out duration-300 transform hover:scale-105 h-14 opacity-50">
                    Procedi al Pagamento
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.hover\:glow:hover {
    box-shadow: 0px 0px 10px 5px rgba(0, 77, 77, 0.4);
}
</style>

<script>
    const proceedButton = document.getElementById('proceedButton');

    /**
     * Calcola il totale e gestisce lo stato del bottone
     */
    function calculateTotal() {
        const checkboxes = document.querySelectorAll('input[name="apartments[]"]:checked');
        const totalPriceElement = document.getElementById('totalPrice');
        const alertMessage = document.getElementById('alertMessage');
        const pricePerApartment = 9.99;
        let total = checkboxes.length * pricePerApartment;
        totalPriceElement.textContent = total.toFixed(2) + ' €';

        // abilita/disabilita bottone
        if (checkboxes.length > 0) {
            proceedButton.disabled = false;
            proceedButton.classList.remove('opacity-50');
            proceedButton.classList.add('opacity-100');
            alertMessage.classList.add('hidden');
        } else {
            proceedButton.disabled = true;
            proceedButton.classList.add('opacity-50');
            proceedButton.classList.remove('opacity-100');
            alertMessage.classList.remove('hidden');
        }
    }

    function proceedToPayment() {
        const selectedApartments = Array.from(document.querySelectorAll('input[name="apartments[]"]:checked')).map(cb => cb.value);
        const totalPrice = document.getElementById('totalPrice').textContent.replace(' €', '');

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('payment') }}';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        selectedApartments.forEach(apartmentId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'apartments[]';
            input.value = apartmentId;
            form.appendChild(input);
        });

        const priceInput = document.createElement('input');
        priceInput.type = 'hidden';
        priceInput.name = 'totalPrice';
        priceInput.value = totalPrice;
        form.appendChild(priceInput);

        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'sponsorshipType';
        typeInput.value = 'Gold';
        form.appendChild(typeInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
