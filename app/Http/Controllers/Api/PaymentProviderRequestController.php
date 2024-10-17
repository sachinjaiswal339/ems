<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProviderRequest;

class PaymentProviderRequestController extends Controller
{
    public function index()
    {
        // Fetch all payment provider requests with their status
        $requests = PaymentProviderRequest::all();

        return response()->json(['message' => 'success', 'data'=> $requests], 200);
    }
}
