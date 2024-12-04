@extends('dashboard')

@section('header', 'Piano sponsorizzazione')

@section('content')
<div class="bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 text-white pt-12 pb-12">
    <div class="flex flex-col justify-center items-center min-h-screen">
        <!-- Titolo e sottotitolo -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold mb-2 text-gray-200">Scegli il piano di sponsorizzazione giusto per il tuo appartamento.</h1>
            <p class="text-lg text-gray-200">Seleziona un piano che si adatta al meglio alle tue esigenze per massimizzare la visibilità del tuo appartamento in affitto.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mx-4">
            <!-- Bronze Plan -->
            <div class="relative p-12 py-10 bg-gradient-to-br from-yellow-800 to-white rounded-2xl text-center shadow-xl w-full md:w-96 mx-auto flex flex-col justify-between h-full transform transition-transform hover:scale-105 overflow-hidden">
                <img class="absolute top-0 left-0 w-full h-full object-cover opacity-20 z-0 mix-blend-overlay" src="{{ asset('images/bronze_overlay.jpg') }}" alt="Overlay">
                <form action="{{ route('bronze') }}" method="GET">
                    @csrf
                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold mb-12 text-white drop-shadow-lg">Bronze</h2>
                        <div class="relative mb-6">
                            <span class="absolute top-0 left-1/2 transform -translate-x-1/2 text-9xl font-extrabold text-white opacity-20">7</span>
                            <p class="text-7xl font-extrabold mb-6 text-gray-200 relative z-20 mt-6 drop-shadow-lg">2,99 €</p>
                            <p class="text-md text-gray-100 relative z-20 drop-shadow-lg mb-20">Per 7 giorni</p>
                        </div>
                        <ul class="mb-20 space-y-3 text-gray-100 relative z-20 drop-shadow-lg">
                            <li>Fino a 10 immagini dell'appartamento</li>
                            <li>Visibilità per 7 giorni</li>
                            <li>Supporto via email</li>
                        </ul>
                    </div>
                    <div class="flex justify-center mt-auto">
                        <button class="w-8/12 px-6 py-3 bg-[#967305] text-white rounded-full shadow-lg hover:bg-yellow-500 focus:outline-none transition-all duration-300 transform hover:scale-105 h-12">Inizia</button>
                    </div>
                </form>
            </div>
        
            <!-- Silver Plan -->
            <div class="relative p-12 py-10 bg-gradient-to-br from-gray-700 to-gray-100 rounded-2xl text-center shadow-xl w-full md:w-96 mx-auto flex flex-col justify-between h-full transform transition-transform hover:scale-105 overflow-hidden">
                <img class="absolute top-0 left-0 w-full h-full object-cover opacity-20 z-0 mix-blend-overlay" src="{{ asset('images/silver_overlay.jpg') }}" alt="Overlay">
                <form action="{{ route('silver') }}" method="GET">
                    @csrf
                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold mb-12 text-white drop-shadow-lg">Silver</h2>
                        <div class="relative mb-6">
                            <span class="absolute top-0 left-1/2 transform -translate-x-1/2 text-9xl font-extrabold text-gray-300 opacity-20">30</span>
                            <p class="text-7xl font-extrabold mb-6 text-gray-800 relative z-20 mt-6 drop-shadow-lg">5,99 €</p>
                            <p class="text-md text-gray-700 font-semibold relative z-20 drop-shadow-lg mb-20">Per 30 giorni</p>
                        </div>
                        <ul class="mb-20 space-y-3 text-gray-800 relative z-20 drop-shadow-lg">
                            <li>Fino a 25 immagini dell'appartamento</li>
                            <li>Visibilità per 30 giorni</li>
                            <li>Supporto prioritario via email</li>
                        </ul>
                    </div>
                    <div class="flex justify-center mt-auto">
                        <button class="w-8/12 px-6 py-3 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-500 focus:outline-none transition-all duration-300 transform hover:scale-105 h-12">Inizia</button>
                    </div>
                </form>
            </div>
        
            <!-- Gold Plan -->
            <div class="relative p-12 py-10 bg-gradient-to-br from-yellow-700 to-yellow-200 rounded-2xl text-center shadow-xl w-full md:w-96 mx-auto flex flex-col justify-between h-full transform transition-transform hover:scale-105 overflow-hidden">
                <img class="absolute top-0 left-0 w-full h-full object-cover opacity-20 z-0 mix-blend-overlay" src="{{ asset('images/gold_overlay.jpg') }}" alt="Overlay">
                <form action="{{ route('gold') }}" method="GET">
                    @csrf
                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold mb-12 text-white drop-shadow-lg">Gold</h2>
                        <div class="relative mb-6">
                            <span class="absolute top-0 left-1/2 transform -translate-x-1/2 text-9xl font-extrabold text-yellow-200 opacity-20">90</span>
                            <p class="text-7xl font-extrabold mb-6 text-yellow-900 relative z-20 mt-6 drop-shadow-lg">9,99 €</p>
                            <p class="text-md text-yellow-900 font-semibold relative z-20 drop-shadow-lg mb-20">Per 90 giorni</p>
                        </div>
                        <ul class="mb-20 space-y-3 text-yellow-900 relative z-20 drop-shadow-lg">
                            <li>Fino a 50 immagini dell'appartamento</li>
                            <li>Visibilità per 90 giorni</li>
                            <li>Supporto dedicato</li>
                            <li>Posizione prioritaria nella ricerca</li>
                        </ul>
                    </div>
                    <div class="flex justify-center mt-auto">
                        <button class="w-8/12 px-6 py-3 bg-yellow-900 text-white rounded-full shadow-lg hover:bg-yellow-700 focus:outline-none transition-all duration-300 transform hover:scale-105 h-12">Inizia</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-8 text-center text-gray-200">
            <p>Domande sulla sicurezza e sui nostri piani? <a href="#" class="text-yellow-500 hover:underline">Contattaci</a>.</p>
        </div>

        <!-- Sezione per le aziende -->
        <div class="mt-12 w-full bg-gradient-to-r from-neutral-900 via-neutral-800 to-neutral-900 text-gray-200 p-8 shadow-lg">
            <p class="text-center mb-8 text-lg">Siamo orgogliosi di collaborare con aziende leader nel settore immobiliare. Ecco alcune delle aziende che si affidano a noi per migliorare la loro visibilità e raggiungere più clienti.</p>
            <div class="flex justify-center items-center space-x-8">
                <img src="https://images.unsplash.com/photo-1496200186974-4293800e2c20?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bG9nb3xlbnwwfHwwfHx8Mg%3D%3D" alt="Logo Azienda 1" class="h-16">
                <img src="https://images.unsplash.com/photo-1620288627223-53302f4e8c74?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bG9nb3xlbnwwfHwwfHx8Mg%3D%3D" alt="Logo Azienda 2" class="h-16">
                <img src="https://cdn2.unrealengine.com/12br-delay-social-news-header-02-1920x1080-119208936.jpg" alt="Logo Azienda 3" class="h-16">
                <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bG9nb3xlbnwwfHwwfHx8Mg%3D%3D" alt="Logo Azienda 4" class="h-16">
                <img src="https://images.unsplash.com/photo-1521747116042-5a810fda9664?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bG9nb3xlbnwwfHwwfHx8Mg%3D%3D" alt="Logo Azienda 5" class="h-16">
            </div>
        </div>

        <div class="py-12"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-200 drop-shadow-md text-center mb-8">Domande Frequenti</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- FAQ Item 1 -->
                    <div class="bg-neutral-800 p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-yellow-500 mb-2">Qual è il periodo di visibilità per il piano Bronze?</h3>
                        <p class="text-gray-300">Il piano Bronze offre visibilità per 7 giorni, ideale per chi desidera un'esposizione breve ma efficace.</p>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="bg-neutral-800 p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-yellow-500 mb-2">Come posso contattare il supporto?</h3>
                        <p class="text-gray-300">Puoi contattare il nostro supporto via email per qualsiasi domanda o problema che incontri.</p>
                    </div>
                    <!-- FAQ Item 3 -->
                    <div class="bg-neutral-800 p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-yellow-500 mb-2">Posso aggiornare il mio piano in qualsiasi momento?</h3>
                        <p class="text-gray-300">Sì, puoi aggiornare il tuo piano in qualsiasi momento accedendo al tuo account e selezionando un nuovo piano.</p>
                    </div>
                    <!-- FAQ Item 4 -->
                    <div class="bg-neutral-800 p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-yellow-500 mb-2">Quali metodi di pagamento accettate?</h3>
                        <p class="text-gray-300">Accettiamo tutte le principali carte di credito e debito, oltre a PayPal per la tua comodità.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

</style>