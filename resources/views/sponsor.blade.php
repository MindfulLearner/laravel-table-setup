@extends('dashboard')

@section('header', 'Piano sponsorizzazione')

@section('content')
<div class="bg-gray-200 text-white pt-12 pb-12">
    <div class="flex flex-col justify-center items-center min-h-screen">
        <!-- Titolo e sottotitolo -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-2 text-gray-800">Scegli il piano di sponsorizzazione giusto per il tuo appartamento.</h1>
            <p class="text-lg text-gray-800">Seleziona un piano che si adatta al meglio alle tue esigenze per massimizzare la visibilità del tuo appartamento in affitto.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mx-4">
            <!-- Hobby Plan -->
            <div class="p-6 bg-gray-800 rounded-lg text-center shadow-lg border-4 border-[#b49578] w-full md:w-80 mx-auto flex flex-col justify-between h-full">
                <div>
                    <form action="{{ route('bronze') }}" method="GET">
                        @csrf
                        <h2 class="text-2xl font-bold mb-4">Bronze</h2>
                        <p class="text-4xl font-bold mb-6">2,99 €</p>
                        <ul class="mb-6 space-y-2">
                        <li>✅ Fino a 10 immagini dell'appartamento</li>
                            <li>✅ Visibilità per 7 giorni</li>
                            <li>✅ Supporto via email</li>
                        </ul>
                </div>
                <div class="flex justify-center mt-auto">
                    <button class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 h-12">Inizia</button>
                    </form>
                </div>
            </div>
            <!-- Pro Plan -->
            <div class="p-6 bg-gradient-to-br from-purple-600 to-yellow-400 rounded-lg text-center shadow-lg border-4 border-[#b49578] w-full md:w-80 mx-auto flex flex-col justify-between h-full">
                <div>
                    <form action="{{ route('silver') }}" method="GET">
                        @csrf
                        <h2 class="text-2xl font-bold mb-4">Silver</h2>
                        <p class="text-4xl font-bold mb-6">5.99 €</p>
                        <ul class="mb-6 space-y-2">
                            <li>✅ Fino a 25 immagini dell'appartamento</li>
                            <li>✅ Visibilità per 30 giorni</li>
                            <li>✅ Supporto prioritario via email</li>
                        </ul>
                </div>
                <div class="flex justify-center mt-auto">
                    <button class="px-6 py-2 bg-black text-white rounded hover:bg-gray-800 h-12">Inizia</button>
                    </form>
                </div>
            </div>
            <!-- Business Plan -->
            <div class="p-6 bg-gray-800 rounded-lg text-center shadow-lg border-4 border-[#b49578] w-full md:w-80 mx-auto flex flex-col justify-between h-full">
                <div>
                    <form action="{{ route('gold') }}" method="GET">
                        @csrf
                        <h2 class="text-2xl font-bold mb-4">Gold</h2>
                        <p class="text-4xl font-bold mb-6">9.99 €</p>
                        <ul class="mb-6 space-y-2">
                        <li>✅ Fino a 50 immagini dell'appartamento</li>
                        <li>✅ Visibilità per 90 giorni</li>
                        <li>✅ Supporto dedicato</li>
                        <li>✅ Posizione prioritaria nella ricerca</li>
                        </ul>
                </div>
                <div class="flex justify-center mt-auto">
                    <button class="px-6 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 h-12">Inizia</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="mt-8 text-center text-gray-800">
            <p>Domande sulla sicurezza e sui nostri piani? <a href="#">Contattaci</a>.</p>
        </div>

        <!-- Sezione per le aziende -->
        <div class="mt-12 w-full bg-gray-100 text-gray-800 p-8 rounded-lg shadow-lg">
            <p class="text-center mb-8">Siamo orgogliosi di collaborare con aziende leader nel settore immobiliare. Ecco alcune delle aziende che si affidano a noi per migliorare la loro visibilità e raggiungere più clienti.</p>
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
                <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Domande Frequenti</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- FAQ Item 1 -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Qual è il periodo di visibilità per il piano Bronze?</h3>
                        <p class="text-gray-700">Il piano Bronze offre visibilità per 7 giorni, ideale per chi desidera un'esposizione breve ma efficace.</p>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Come posso contattare il supporto?</h3>
                        <p class="text-gray-700">Puoi contattare il nostro supporto via email per qualsiasi domanda o problema che incontri.</p>
                    </div>
                    <!-- FAQ Item 3 -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Posso aggiornare il mio piano in qualsiasi momento?</h3>
                        <p class="text-gray-700">Sì, puoi aggiornare il tuo piano in qualsiasi momento accedendo al tuo account e selezionando un nuovo piano.</p>
                    </div>
                    <!-- FAQ Item 4 -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Quali metodi di pagamento accettate?</h3>
                        <p class="text-gray-700">Accettiamo tutte le principali carte di credito e debito, oltre a PayPal per la tua comodità.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
