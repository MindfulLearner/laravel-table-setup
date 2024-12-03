<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsorship;
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
        $superId = Auth::user()->id;
        $apartments = Apartment::where('user_id', $superId)->get();

        return view('sponsors.createSilver', compact('apartments'));
    }

    public function createGold()
    {
        $superId = Auth::user()->id;
        $apartments = Apartment::where('user_id', $superId)->get();
        return view('sponsors.createGold', compact('apartments'));
    }

    public function updateSponsorBronze(Request $request)
    {
        $sponsorships = Sponsorship::where('name', 'Bronze')->first();
        foreach ($request->apartments as $apartment) {
            $apartment = Apartment::find($apartment);
            $apartment->sponsorships()->attach($sponsorships);
        }

        $superId = Auth::user()->id;
        $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
        return view('apartments.index', compact('apartments', 'superId'));
    }

    public function updateSponsorSilver(Request $request)
    {
        dd($request->all());
    }

    public function updateSponsorGold(Request $request)
    {
        dd($request->all());
    }
}
