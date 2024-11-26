@extends('dashboard')


@section('content')
    <h2>Mappa degli Appartamenti</h2>
    <div id="map" style="height: 400px; width: 100%;"></div>



    <script>

        const tomTomApiKey = "SooRbYbji9V5qUxAh3i2ijnD8m9ZWVZ7";
        // Dati passati dal controller Laravel
        const apartments = @json($apartments);
        var map = tt.map({
            key: tomTomApiKey,
            container: "map",
        })


        // Aggiunta dei marker
        // apartments.forEach(apartment => {
        //     if (apartment.latitude && apartment.longitude) {
        //         new tt.Marker()
        //             .setLngLat([apartment.longitude, apartment.latitude])
        //             .addTo(map);
        //     }
        // });

    </script>
@endsection
