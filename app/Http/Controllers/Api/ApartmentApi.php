<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\View;
use Illuminate\Support\Facades\Cache;

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
        try {
            $apartments = Apartment::with('services', 'sponsorships', 'images')->get();
            return response()->json([
                'success' => true,
                'data' => $apartments,
                'message' => 'Apartments retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
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
            'data' => Apartment::with('services', 'sponsorships')->find($apartment->id),
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
            "latitude" => "nullable|numeric",
            "longitude" => "nullable|numeric",
            "services" => "nullable|array",
            "sponsorships" => "nullable|array",
            "image" => "nullable|string",
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
            'data' => Apartment::with('services', 'sponsorships')->find($apartment->id),
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
     * Show an apartment
     */
    public function show($id)
    {
        try {
            $apartment = Apartment::with('services', 'sponsorships', 'images')->find($id);
            return response()->json([
                'success' => true,
                'data' => $apartment,
                'services' => $apartment->services,
                'sponsorships' => $apartment->sponsorships,
                'message' => 'Apartment retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function incrementViews($id)
    {
        try {
            $ip = request()->ip();
            $cacheKey = 'views_counter_' . $id . '_' . $ip;

        if (!Cache::has($cacheKey)) {
            Cache::put($cacheKey, true, 60);
            $views = new View();
            $views->ip_address = $ip;
            $views->apartment_id = $id;
            $views->date = now();
            $views->save();
        } else {
            return response()->json(['message' => 'View already counted'], 400);
        }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
