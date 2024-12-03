@extends('dashboard')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-4xl mx-auto bg-gradient-to-r from-gray-300 to-gray-500 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Seleziona Appartamenti per il Piano Silver</h2>
        {{-- <form action="{{ route('') }}" method="POST"> --}}
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Qui ci fa il foreach apartments as apartment -->
                {{-- @foreach($apartments as $apartment) --}}
                    <div class="border p-4 rounded-lg shadow-sm bg-white">
                        <h3 class="text-lg font-semibold"> {{--{{ $apartment->name }} --}} </h3>
                        <p class="text-gray-600">{{--{{ $apartment->description }} --}} </p>
                        <p class="text-gray-800 font-bold">Prezzo: 5,99 €</p>
                        <div class="mt-2">
                            <input type="checkbox" name="apartments[]" value="{{--{{ $apartment->id }}--}}" class="mr-2" onchange="calculateTotal()">
                            <label for="apartment-{{--{{ $apartment->id }}--}}" class="text-gray-700">Seleziona</label>
                        </div>
                    </div>
                <!-- Fine del foreach -->
            </div>
            <div class="mt-6">
                <p class="text-xl font-bold">Prezzo Totale: <span id="totalPrice">0,00 €</span></p>
            </div>
            <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Attiva Piano Silver</button>
        {{-- </form> --}}
    </div>
</div>

<script>
    function calculateTotal() {
        const checkboxes = document.querySelectorAll('input[name="apartments[]"]:checked');
        const totalPriceElement = document.getElementById('totalPrice');
        const pricePerApartment = 5.99;
        let total = checkboxes.length * pricePerApartment;
        totalPriceElement.textContent = total.toFixed(2) + ' €';
    }
</script>
@endsection
