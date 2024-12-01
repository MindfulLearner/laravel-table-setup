<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Apartment;

class ImageUploadController extends Controller
{

    /**
     * invoke
     */
    public function __invoke(Request $request)
    {

        $path = $request->file('file')->storePublicly('images');

        return response()->json(['message' => 'Image uploaded successfully', 'path' => "https://mybucketlaravel.s3.eu-west-3.amazonaws.com/$path"]);
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroyImage(string $id)
     {
         $image = Image::findOrFail($id);

         if (strpos($image->image_path, "https://mybucketlaravel.s3.eu-west-3.amazonaws.com/") !== false) {
            $this->deleteImage($image->image_path);
         }
         $currentEditPage = Apartment::findOrFail($image->apartment_id);

         // controlla se è l'ultima immagine
         if ($currentEditPage->images()->count() <= 1) {
             return redirect()->route('apartments.edit', $image->apartment_id)
                 ->withErrors(['error' => 'Devi tenere almeno un\'immagine']);
         }

         $image->delete();
         return redirect()->route('apartments.edit', $currentEditPage->id);
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
