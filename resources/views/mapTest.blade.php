@extends('htmlTest')


@section('content')
    <h2>Mappa degli Appartamenti</h2>
    <div id="map"></div>

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/services/services-web.min.js"></script>

    <script>


        // Dati passati dal controller Laravel
        const apartments = @json($apartments);


        const tt = window.tt;

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
