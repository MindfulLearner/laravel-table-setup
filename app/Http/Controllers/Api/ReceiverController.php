<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ReceiverController extends Controller
{
    public function __invoke(Request $request)
    {


        try {
            if (response()->json(['message' => 'Request processed successfully', 'data' => $request->all()])) {
                $validated = $request->validate([
                    'message' => 'required|string|max:255',
                    'email_sender' => 'required|email|max:255',
                    'recipient_name' => 'required|string|max:255',
                    'apartment_id' => 'required|integer',
                ]);

                $receiver = Message::create($validated);

                return response()->json(['message' => 'Request processed successfully', 'data' => $receiver], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
