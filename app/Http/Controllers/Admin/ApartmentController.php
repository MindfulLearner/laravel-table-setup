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
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

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
        $apartments = Apartment::where('user_id', $superId)->with('sponsorships', 'services', 'images')->get();

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


        $request->file('cover_image');
        $request->file('images');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1|max:10',
            'beds' => 'required|integer|min:1|max:10',
            'bathrooms' => 'required|integer|min:1|max:10',
            'services' => 'required|array',
            'sponsorship' => 'required|integer',
            'description' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'images' => 'required|array',
            'address' => 'required|string|max:255',
            'is_visible' => 'required|boolean',
        ]);

        $existingApartment = Apartment::where('address', $request->address)->first();
        if ($existingApartment) {
            return redirect()->back()->withErrors(['address' => 'Questo indirizzo esiste già nel database.']);
        }

        foreach ($request->file('images') as $image) {
            $imageUrl = $this->addImage($image);
            $images[] = $imageUrl;
        }


        $imageUrl = $this->addImage($request->file('cover_image'));

        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['cover_image'] = $imageUrl;
        $arrayAddress = $this->getAddress($data['address']);
        $data['address'] = $arrayAddress['address'];
        $data['latitude'] = $arrayAddress['latitude'];
        $data['longitude'] = $arrayAddress['longitude'];

        //  controllo se l'indirizzo esiste già nel database


        // creo l'appartamento
        $apartment = Apartment::create($data);
        $apartment->services()->sync($data['services']);
        $apartment->sponsorships()->sync($data['sponsorship']);

   for ($i = 0; $i < count($images); $i++) {
            $image_description = $request->input('image_description')[$i];
            Image::create([
                'image_path' => $images[$i],
                'description' => $image_description,
                'apartment_id' => $apartment->id,
            ]);
        }
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
        $images = Image::where('apartment_id', $id)->get();

        return view('apartments.show', compact('apartment', 'services', 'sponsorships', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $services = Service::all();
        $sponsorships = Sponsorship::all();
        $images = Image::where('apartment_id', $id)->get();


        $apartment = Apartment::findOrFail($id);


        return view('apartments.edit', compact('apartment', 'services', 'sponsorships', 'images'));
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


        $urlCheck = "https://mybucketlaravel.s3.eu-west-3.amazonaws.com/";

        if (strpos($apartment->cover_image, $urlCheck) !== false) {
            $this->deleteImage($apartment->cover_image);
        }


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


public function destroyImage(string $id) {
    $image = Image::findOrFail($id);
    $currentEditPage = Apartment::findOrFail($image->apartment_id);
    $image->delete();
    return redirect()->route('apartments.edit', $currentEditPage->id);
}



    public function deleteImage($image_string) {
        $url = $image_string;
        $parts = explode('/images/', $url);
        $imagePath = '/images/' . $parts[1];

        if (Storage::disk('s3')->exists($imagePath)) {
            Storage::disk('s3')->delete($imagePath);
            return response()->json(['message' => 'Image deleted successfully']);
        }

        return response()->json(['message' => 'Image not found'], 404);
    }

    public function addImage($image_string) {
        $path = $image_string->storePublicly('images');
        $imageUrl = "https://mybucketlaravel.s3.eu-west-3.amazonaws.com/$path";
        return $imageUrl;
    }





}
