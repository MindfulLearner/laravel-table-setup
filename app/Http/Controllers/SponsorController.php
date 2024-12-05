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
        $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
         return view('sponsors.createBronze', compact('superId', 'apartments'));
    }

    public function createSilver()
    {
        $superId = Auth::user()->id;
        $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
        return view('sponsors.createSilver', compact('apartments'));
    }

    public function createGold()
    {
        $superId = Auth::user()->id;
        $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
        return view('sponsors.createGold', compact('apartments'));
    }

    public function updateSponsorBronze(Request $request)
    {

        // gestiamo il pagamento con braintree
        $payment = new PaymentController();
        $response = $payment->checkout($request);
        if ($response->getStatusCode() != 200) {
            return redirect()->back()->with('error', 'Errore durante il pagamento');
        } else {
            $sponsorships = Sponsorship::where('name', 'Bronze')->first();
            $decodedApartments = json_decode($request->apartments, true);
            foreach ($decodedApartments as $apartment) {
                $apartment = Apartment::find($apartment['id']);
                $apartment->sponsorships()->attach($sponsorships);
            }

            $superId = Auth::user()->id;
            $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
            $successPayment = 'Pagamento effettuato!';
            return view('apartments.index', compact('apartments', 'superId', 'successPayment'));
        }
    }

    public function updateSponsorSilver(Request $request)
    {
        $payment = new PaymentController();
        $response = $payment->checkout($request);
        if ($response->getStatusCode() != 200) {
            return redirect()->back()->with('error', 'Errore durante il pagamento');
        } else {
            $sponsorships = Sponsorship::where('name', 'Silver')->first();
            foreach ($request->apartments as $apartment) {
            $apartment = Apartment::find($apartment);
                $apartment->sponsorships()->attach($sponsorships);
            }

            $superId = Auth::user()->id;
            $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
            $successPayment = 'Pagamento effettuato!';
            return view('apartments.index', compact('apartments', 'superId', 'successPayment'));
        }
    }

    public function updateSponsorGold(Request $request)
    {
        $payment = new PaymentController();
        $response = $payment->checkout($request);
        if ($response->getStatusCode() != 200) {
            return redirect()->back()->with('error', 'Errore durante il pagamento');
        } else {
            $sponsorships = Sponsorship::where('name', 'Gold')->first();
            foreach ($request->apartments as $apartment) {
            $apartment = Apartment::find($apartment);
            $apartment->sponsorships()->attach($sponsorships);
        }

        $superId = Auth::user()->id;
            $apartments = Apartment::where('user_id', $superId)->with('sponsorships')->get();
            $successPayment = 'Pagamento effettuato!';
            return view('apartments.index', compact('apartments', 'superId', 'successPayment'));
        }
    }

    public function showPaymentPage(Request $request)
    {
        // Recupera gli appartamenti selezionati e il prezzo totale dalla richiesta
        $selectedApartments = Apartment::whereIn('id', $request->input('apartments', []))->get();
        $totalPrice = $request->input('totalPrice', 0);
        $sponsorshipType = $request->input('sponsorshipType', 'Bronze');

        return view('sponsors.payment', compact('selectedApartments', 'totalPrice', 'sponsorshipType'));
    }
}
