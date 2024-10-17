<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        // Fetch all available payment methods
        $paymentMethods = PaymentMethod::all();

        return response()->json(['message' => 'success', 'data'=> $paymentMethods], 200);
    }
}
