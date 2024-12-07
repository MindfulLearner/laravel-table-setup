<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Apartment;
use App\Models\Message;
class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $apartments = Apartment::where('user_id', $user->id)->with('messages')->get();
        $newMessages = [];

        foreach ($apartments as $apartment) {
            foreach ($apartment->messages as $message) {
                if ($message['created_at'] > now()->subMinutes(5)) {
                    $newMessages[] = $message;
                }
            }
        }

        return response()->json($newMessages);
    }
}
