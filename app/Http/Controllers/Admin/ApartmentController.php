<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Sponsorship;
use App\Models\Service;
class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $apartments = Apartment::all();
        // $superId = Auth::user()->id;
        // // query che prende tutti gli appartamenti dell'utente
        // return view('apartments.index', compact('apartments', 'superId'));

        // query che prende tutti gli appartamenti dell'utente
        $superId = Auth::user()->id;
        // query che prende tutti gli appartamenti dell'utente
        $apartments = Apartment::where('user_id', $superId)->with('sponsorships', 'services')->get();

        // passiamo i dati sponsorship che tipologie di sponsorizzazione hanno
        // Modifica per ottenere solo le sponsorizzazioni legate agli appartamenti dell'utente




         return view('apartments.index', compact('superId', 'apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $sponsorships = Sponsorship::all();
        return view('apartments.create', compact('services', 'sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1|max:10',
            'beds' => 'required|integer|min:1|max:10',
            'bathrooms' => 'required|integer|min:1|max:10',
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_visible' => 'required|boolean',
        ]);


        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $arrayAddress = $this->getAddress($data['address']);
        $data['address'] = $arrayAddress['address'];
        $data['latitude'] = $arrayAddress['latitude'];
        $data['longitude'] = $arrayAddress['longitude'];

        //  controllo se l'indirizzo esiste già nel database
        $existingApartment = Apartment::where('address', $data['address'])->first();
        if ($existingApartment) {
            return redirect()->back()->withErrors(['address' => 'Questo indirizzo esiste già nel database.']);
        }

        // creo l'appartamento
        $apartment = Apartment::create($data);
        $apartment->services()->sync($data['services']);
        $apartment->sponsorships()->sync($data['sponsorship']);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {



        $apartment = Apartment::findOrFail($id);
        $services = Service::all();
        $sponsorships = Sponsorship::all();

        return view('apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $services = Service::all();
        $sponsorships = Sponsorship::all();


        $apartment = Apartment::findOrFail($id);


        return view('apartments.edit', compact('apartment', 'services', 'sponsorships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $apartment = Apartment::findOrFail($id);
        $apartment->update($data);
        $apartment->services()->sync($data['services']);
        $apartment->sponsorships()->sync($data['sponsorship']);
        return redirect()->route('dashboard')->with('success', 'Appartamento aggiornato con successo');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();
        return redirect()->route('dashboard');
    }

    public function getAddress($indirizzo) {
        $apiTomTomKey = env('API_TOMTOM_KEY');
        $infoArrayAddress = [];
        $url = "https://api.tomtom.com/search/2/geocode/" . urlencode($indirizzo) . ".json?key=$apiTomTomKey&limit=1&countrySet=IT&language=it-IT";
        $response = Http::get($url);
        $response = $response->json();
        $infoArrayAddress['latitude'] = $response['results'][0]['position']['lat'];
        $infoArrayAddress['longitude'] = $response['results'][0]['position']['lon'];
        $infoArrayAddress['address'] = $response['results'][0]['address']['freeformAddress'];

        return $infoArrayAddress;
    }

    public function controlIfAdressIsCorrect($indirizzo) {

    }

}
