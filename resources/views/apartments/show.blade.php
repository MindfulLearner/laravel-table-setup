@extends('dashboard')

@section('header', 'Dettagli appartamento')

@section('content')
<div class="max-w-4xl mx-auto bg-gradient-to-r from-neutral-900 via-[#003441] to-neutral-900 shadow-xl rounded-lg p-10 mt-10">

    <!-- Titolo dell'appartamento -->
    <h1 class="text-3xl font-extrabold text-gray-200 mb-8 text-center border-b-4 border-yellow-500 pb-4">
        {{ $apartment->title }}
    </h1>

    <!-- Immagine copertina dell'appartamento -->
    <img src="{{ $apartment->cover_image }}" alt="Property Image" class="w-full h-64 object-cover mb-8 rounded-lg border-2 shadow-xl border-neutral-700" />

    <!-- Dettagli dell'appartamento -->
    <div class="mb-8 p-8 bg-gradient-to-r from-neutral-800 via-neutral-700 to-neutral-800 rounded-xl shadow-md">
        <!-- Informazioni sulle stanze -->
        <p class="text-lg font-semibold text-gray-200"><strong>Stanze:</strong> <span class="text-yellow-500">{{ $apartment->rooms }}</span></p>
        <p class="text-lg font-semibold text-gray-200"><strong>Letti:</strong> <span class="text-yellow-500">{{ $apartment->beds }}</span></p>
        <p class="text-lg font-semibold text-gray-200"><strong>Bagni:</strong> <span class="text-yellow-500">{{ $apartment->bathrooms }}</span></p>
        <p class="text-lg font-semibold text-gray-200"><strong>Metri Quadri:</strong> <span class="text-yellow-500">{{ $apartment->square_meters }} m²</span></p>

        <!-- Informazioni sull'indirizzo -->
        <p class="text-lg font-semibold text-gray-200"><strong>Indirizzo:</strong> <span class="text-yellow-500">{{ $apartment->address }}</span></p>

        <!-- Informazioni sui servizi -->
        <p class="text-lg font-semibold text-gray-200"><strong>Servizi:</strong>
            <span class="text-yellow-500">
                @foreach ($apartment->services as $service)
                    {{ $service->name }}@if (!$loop->last), @endif
                @endforeach
            </span>
        </p>

        <!-- Informazioni sulle coordinate -->
        <p class="text-lg font-semibold text-gray-200"><strong>Coordinate:</strong> <span class="text-yellow-500">{{ $apartment->latitude }}, {{ $apartment->longitude }}</span></p>

        <!-- Informazioni sulla visibilità -->
        <p class="text-lg font-semibold text-gray-200"><strong>Visibilità:</strong> <span class="text-yellow-500">{{ $apartment->is_visible ? 'Visibile' : 'Non Visibile' }}</span></p>

        <br>

        <!-- Informazioni sulle sponsorizzazioni -->
        <div class="mt-6 space-y-4">
            <h3 class="text-xl font-bold text-white mb-4">Sponsorizzazioni</h3>
            <div class="flex flex-wrap gap-4">
                @if($apartment->sponsorships->where('name', 'Bronze')->first())
                    <div class="flex items-center px-6 py-3 bg-gradient-to-r from-yellow-700 to-yellow-900 rounded-xl shadow-lg border-2 border-yellow-600 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-medal text-yellow-700 text-2xl mr-3"></i>
                        <div>
                            <span class="text-lg font-bold text-yellow-500">Bronze</span>
                            <span class="ml-2 text-sm text-green-400 font-semibold">• Attivo</span>
                            {{-- contiamo quanti Bronze attivi ci sono in un appartamento --}}
                            @php
                                $bronzeCount = 0;
                                foreach ($apartment->sponsorships as $sponsorship) {
                                    if ($sponsorship->name == 'Bronze') {
                                        $bronzeCount++;
                                    }
                                }
                            @endphp
                            <div>
                                ci sono {{ $bronzeCount }} Bronze attivi
                            </div>

                            {{-- durata totale lo sponsor bronze attivo --}}
                            @php
                                $bronzeDuration = 0;
                                foreach ($apartment->sponsorships as $sponsorship) {
                                    if ($sponsorship->name == 'Bronze') {
                                        $bronzeDuration += $sponsorship->duration;
                                    }
                                }
                            @endphp
                            <div>
                                durata totale lo sponsor bronze attivo: {{ $bronzeDuration }} ore
                            </div>
                        </div>


                    </div>
                @else
                    <div class="flex items-center px-6 py-3 bg-neutral-800 rounded-xl shadow-md opacity-50">
                        <i class="fas fa-medal text-yellow-700 text-2xl mr-3"></i>
                        <div>
                            <span class="text-lg font-bold text-yellow-700">Bronze</span>
                            <span class="ml-2 text-sm text-red-500 font-semibold">• Inattivo</span>
                        </div>
                    </div>

                @endif

                @if($apartment->sponsorships->where('name', 'Silver')->first())
                    <div class="flex items-center px-6 py-3 bg-gradient-to-r from-gray-400 to-gray-600 rounded-xl shadow-lg border-2 border-gray-300 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-medal text-gray-300 text-2xl mr-3"></i>
                        <div>
                            <span class="text-lg font-bold text-gray-200">Silver</span>
                            <span class="ml-2 text-sm text-green-400 font-semibold">• Attivo</span>

                            <div>

                                {{-- contiamo quanti Silver attivi ci sono in un appartamento --}}
                                @php
                                $silverCount = 0;
                                foreach ($apartment->sponsorships as $sponsorship) {
                                    if ($sponsorship->name == 'Silver') {
                                        $silverCount++;
                                    }
                                }
                            @endphp
                            <div>
                                ci sono {{ $silverCount }} Silver attivi
                            </div>

                            {{-- durata totale lo sponsor silver attivo --}}
                            @php
                                $silverDuration = 0;
                                foreach ($apartment->sponsorships as $sponsorship) {
                                    if ($sponsorship->name == 'Silver') {
                                        $silverDuration += $sponsorship->duration;
                                    }
                                }
                            @endphp
                            <div>
                                durata totale lo sponsor silver attivo: {{ $silverDuration }} ore
                            </div>
                        </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center px-6 py-3 bg-neutral-800 rounded-xl shadow-md opacity-50">
                        <i class="fas fa-medal text-gray-400 text-2xl mr-3"></i>
                        <div>
                            <span class="text-lg font-bold text-gray-400">Silver</span>
                            <span class="ml-2 text-sm text-red-500 font-semibold">• Inattivo</span>
                        </div>
                    </div>
                @endif

                @if($apartment->sponsorships->where('name', 'Gold')->first())
                  <div class="flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-700 rounded-xl shadow-lg border-2 border-yellow-400 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-crown text-yellow-500 text-2xl mr-3"></i>
                        <div>
                            <span class="text-lg font-bold text-yellow-500">Gold</span>
                            <span class="ml-2 text-sm text-green-400 font-semibold">• Attivo</span>

                            <div>
                                {{-- contiamo quanti Gold attivi ci sono in un appartamento --}}
                                @php
                                $goldCount = 0;
                                foreach ($apartment->sponsorships as $sponsorship) {
                                    if ($sponsorship->name == 'Gold') {
                                        $goldCount++;
                                    }
                                }
                            @endphp
                            <div>
                                ci sono {{ $goldCount }} Gold attivi
                            </div>

                            {{-- durata totale lo sponsor gold attivo --}}
                            @php
                                $goldDuration = 0;
                                foreach ($apartment->sponsorships as $sponsorship) {
                                    if ($sponsorship->name == 'Gold') {
                                        $goldDuration += $sponsorship->duration;
                                    }
                                }
                            @endphp
                            <div>
                                durata totale lo sponsor gold attivo: {{ $goldDuration }} ore
                            </div>
                        </div>
                        </div>
                    </div>
                @else
                   <div class="flex items-center px-6 py-3 bg-neutral-800 rounded-xl shadow-md opacity-50">
                        <i class="fas fa-crown text-yellow-400 text-2xl mr-3"></i>
                        <div>
                            <span class="text-lg font-bold text-yellow-300">Gold</span>
                            <span class="ml-2 text-sm text-red-500 font-semibold">• Inattivo</span>
                        </div>
                        </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Immagini aggiuntive dell'appartamento -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-8">
        @foreach ($images as $image)
            <div class="flex flex-col items-center bg-neutral-800 rounded-lg p-4 shadow-lg">
                <img src="{{ $image->image_path }}" alt="Property Image" class="w-full h-32 object-cover mb-4 rounded-lg border-2 shadow-xl border-neutral-700" />
                <p class="text-md text-gray-200">{{ $image->description }}</p>
            </div>
        @endforeach
    </div>

    <!-- Statistiche appartamento -->

    <!-- Stats Section -->
    <div class="p-10 bg-gradient-to-r from-neutral-800 via-neutral-700 to-neutral-800 rounded-lg shadow-xl mt-10 mb-10">
        <h2 class="text-3xl font-bold text-white drop-shadow-md mb-6 text-center">
            {{ __("Statistiche dell'Appartamento") }}
        </h2>

        <!-- Visualizzazioni totali -->
        <div class="text-center text-white drop-shadow-md text-2xl font-extrabold mb-8">
            {{ $views->count() }} <span class="text-2xl font-semibold"> {{ __("Visualizzazioni Totali") }}</span>
        </div>

        <!-- Grafico delle visualizzazioni -->
        <div class="bg-neutral-800 p-6 rounded-lg shadow-lg mb-8">
            <canvas id="viewsChart" class="w-full h-64"></canvas>
        </div>

        <!-- Lista delle Visualizzazioni -->
        <div class="text-white drop-shadow-md text-semibold mb-8 text-center text-xl mt-20">
            {{ __("Dettagli delle Visualizzazioni") }}
        </div>

        @if($views->isNotEmpty())
            <div class="overflow-auto bg-neutral-700 rounded-lg p-6 text-gray-100">
                <table class="min-w-full divide-y divide-gray-600 text-sm">
                    <thead class="bg-neutral-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-white drop-shadow-md uppercase tracking-wider">
                                {{ __("Data Visualizzazione") }}
                            </th>
                            {{-- <th class="px-6 py-3 text-left text-white drop-shadow-md uppercase tracking-wider">
                                {{ __("Indirizzo IP") }}
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-600">
                        @foreach ($views as $view)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $view->created_at->format('d-m-Y H:i:s') }}
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $view->ip_address }}
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-white drop-shadow-md text-center mt-8">
                {{ __("Non ci sono visualizzazioni al momento.") }}
            </p>
        @endif
    </div>

    <!-- Messaggi ricevuti -->
    <div class="bg-neutral-800 p-6 rounded-lg shadow-md mb-10">
        <h2 class="text-2xl font-bold text-yellow-500 mb-6">Messaggi ricevuti</h2>
        @foreach ($messages->sortByDesc('created_at') as $message)
            <div class="border-b border-gray-600 py-4">
                <p class="text-lg text-gray-200 font-semibold mb-2">Data: <span class="text-yellow-500">{{ $message->created_at }}</span></p>
                <p class="text-lg text-gray-200 font-semibold mb-2">Inviato da: <span class="text-blue-400">{{ $message->email_sender }}</span></p>
                <p class="text-md text-gray-300 italic">{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <!-- Link per tornare alla lista degli appartamenti -->
    <div class="text-center">
        <a href="{{ route('apartments.index') }}" class="bg-[#967305] text-white px-6 py-3 rounded-lg shadow-lg font-bold hover:bg-yellow-500 transition-all ease-in-out duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            Torna alla lista degli appartamenti
        </a>
    </div>
</div>

<!-- Aggiungi Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Funzione per generare date fittizie
    function generateFakeData() {
        const now = new Date();
        const data = [];
        let cumulativeCount = 0;

        // Genera 20 date fittizie, una ogni 10 secondi
        for(let i = 0; i < 20; i++) {
            const date = new Date(now - ((19-i) * 10000)); // Invertiamo l'ordine per avere date crescenti
            cumulativeCount += 1; // Incrementa di 1 per ogni visualizzazione
            data.push({
                created_at: date.toISOString(),
                cumulative_count: cumulativeCount
            });
        }
        return data;
    }

    // Usa i dati reali se esistono, altrimenti usa dati fittizi
    const views = @json($views);
    const viewsData = views.length > 0 ?
        views.map((view, index) => ({
            ...view,
            cumulative_count: index + 1 // Aggiunge il conteggio progressivo
        })).sort((a, b) => new Date(a.created_at) - new Date(b.created_at))
        : generateFakeData();

    // Prepara i dati per il grafico
    const timeLabels = viewsData.map(view => {
        const date = new Date(view.created_at);
        return date.toLocaleTimeString('it-IT', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
    });

    const cumulativeCounts = viewsData.map(view => view.cumulative_count);

    // Crea il grafico
    const ctx = document.getElementById('viewsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeLabels,
            datasets: [{
                label: 'Visualizzazioni Totali',
                data: cumulativeCounts,
                borderColor: '#EAB308',
                backgroundColor: 'rgba(234, 179, 8, 0.1)',
                tension: 0,  // Linea dritta tra i punti
                fill: true,
                pointRadius: 6,
                pointBackgroundColor: '#EAB308',
                pointBorderColor: '#000',
                pointBorderWidth: 2,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#FFFFFF',
                pointHoverBorderColor: '#EAB308',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#FFFFFF',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#EAB308',
                    bodyColor: '#FFFFFF',
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return `Visualizzazioni: ${context.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#FFFFFF',
                        stepSize: 1,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    title: {
                        display: true,
                        text: 'Numero di Visualizzazioni',
                        color: '#FFFFFF',
                        font: {
                            size: 14
                        }
                    }
                },
                x: {
                    ticks: {
                        color: '#FFFFFF',
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    title: {
                        display: true,
                        text: 'Orario',
                        color: '#FFFFFF',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
