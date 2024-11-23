<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;

class ApartmentApi extends Controller
{
/**
 * UR (utente registrato)
 * URA (utente registrato con appartamento)
 * UI (utente interessato)
 */

    /**
     * Show public information to UI and UR
     */
    public function index()
    {
        $apartments = Apartment::with('services', 'sponsorships')->get();
        return response()->json([
            'success' => true,
            'data' => $apartments,
            'message' => 'Apartments retrieved successfully'
        ]);
    }


    /**
     * Create an apartment
     */
    public function store(Request $request)
    {
        

        $request->validate([
            "user_id" => "required|exists:users,id",
            "title" => "required|string|max:255",
            "rooms" => "required|integer",
            "beds" => "required|integer",
            "bathrooms" => "required|integer",
            "square_meters" => "required|integer",
            "address" => "required|string",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "image" => "required|string",
            "is_visible" => "required|boolean",
        ]);

        $apartment = Apartment::create($request->all());

        if ($request->has('services')) {
            $apartment->services()->sync($request->input('services'));
        }
        if ($request->has('sponsorships')) {
            $apartment->sponsorships()->sync($request->input('sponsorships'));
        }

        return response()->json([
            'success' => true,
            'data' => $apartment = Apartment::with('services', 'sponsorships')->find($apartment->id),
            'message' => 'Apartment created successfully'
        ]);
    }


    /**
     * Update an apartment
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "user_id" => "exists:users,id",
            "title" => "required|string|max:255",
            "rooms" => "required|integer",
            "beds" => "required|integer",
            "bathrooms" => "required|integer",
            "square_meters" => "required|integer",
            "address" => "required|string",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "image" => "required|string",
            "is_visible" => "required|boolean",
      
        ]);

        $apartment = Apartment::find($id);
        $apartment->update($request->all());

        if ($request->has('services')) {
            $apartment->services()->sync($request->input('services'));
        }
        if ($request->has('sponsorships')) {
            $apartment->sponsorships()->sync($request->input('sponsorships'));
        }
        

        return response()->json([
            'success' => true,
            'data' => $apartment = Apartment::with('services', 'sponsorships')->find($apartment->id),
            'message' => 'Apartment updated successfully'
        ]);
    }

    /**
     * Delete an apartment
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();
        return response()->json([
            'success' => true,
            'data' => $apartment,
            'message' => 'Apartment deleted successfully'
        ]);
    }

    /**
     * Show an apartment by id
     */
    public function show($id)
    {
        $apartment = Apartment::with('services', 'sponsorships')->find($id);
        return response()->json([
            'success' => true,
            'data' => $apartment,
            'message' => 'Apartment retrieved successfully'
        ]);
    }

    /**
     * Filter apartments you can filter by rooms, beds, bathrooms, square meters and price
     */
    public function filter(Request $request)
    {
        $filters = $request->only(['rooms', 'beds', 'bathrooms', 'square_meters', 'price_min', 'price_max', 'services', 'sponsorships']);


        $query = Apartment::query();

        //Numero di stanze
        if (isset($filters['rooms'])) {
            $query->where('rooms', $filters['rooms']);
        }

        //Letti
        if (isset($filters['beds'])) {
            $query->where('beds', $filters['beds']);
        }

        //Bagni
        if (isset($filters['bathrooms'])) {
            $query->where('bathrooms', $filters['bathrooms']);
        }

        //Metri quadrati
        if (isset($filters['square_meters'])) {
            $query->where('square_meters', $filters['square_meters']);
        }

        // Prezzo minimo
        if (isset($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        //Prezzo massimo
        if (isset($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }





        // filtri avanzati servizi e sponsorizzazioni
        // il problema qui e' che non so come filtrare gli array.
        if (isset($filters['services'])) {
            $query->whereHas('services', function ($query) use ($filters) {
                $query->whereIn('id', $filters['services']);
            });
        }

        if (isset($filters['sponsorships'])) {
            $query->whereHas('sponsorships', function ($query) use ($filters) {
                $query->whereIn('id', $filters['sponsorships']);
            });
        }

        // stampa con i servizi e sponsorizzazioni
        $apartments = $query->with(['services', 'sponsorships'])->get();

      

        return response()->json($apartments);
    }
}
