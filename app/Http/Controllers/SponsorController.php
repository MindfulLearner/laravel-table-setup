<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function createBronze()
    {
        return view('sponsors.createBronze');
    }

    public function createSilver()
    {
        return view('sponsors.createSilver');
    }

    public function createGold()
    {
        return view('sponsors.createGold');
    }
}
