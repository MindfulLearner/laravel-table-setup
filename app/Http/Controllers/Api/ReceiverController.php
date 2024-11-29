<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            return response()->json(['message' => 'Request processed successfully', 'data' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
