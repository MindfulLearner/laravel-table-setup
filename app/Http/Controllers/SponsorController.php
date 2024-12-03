<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function createBronze()
    {
        $superId = Auth::user()->id;
        // query che prende tutti gli appartamenti dell'utente
        $apartments = Apartment::where('user_id', $superId)->get();
         return view('sponsors.createBronze', compact('superId', 'apartments'));
    }

    public function createSilver()
    {
        $apartments = Apartment::all();
        return view('sponsors.createSilver', compact('apartments'));
    }

    public function createGold()
    {
        $apartments = Apartment::all();
        return view('sponsors.createGold', compact('apartments'));
    }
}
