<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
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
        return response()->json(Apartment::all());
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

        return response()->json([
            'success' => true,
            'data' => $apartment,
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

        return response()->json([
            'success' => true,
            'data' => $apartment,
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
}
