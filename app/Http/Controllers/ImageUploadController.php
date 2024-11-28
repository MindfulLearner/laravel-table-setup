<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function destroy(string $image_string)
    {

        $path = "images/$image_string"; // idfunziona!!!

        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
            return response()->json(['message' => 'Image deleted successfully']);
        }

        return response()->json(['message' => 'Image not found'], 404);
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


}
