<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
class ApartmentController extends Controller
{
    public function index()
    {
        return response()->json(Apartment::all());
    }
}
