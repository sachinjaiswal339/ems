<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // Fetch all events with their payment configurations
        $events = Event::with('eventPayments')->get();
        return response()->json(['message' => 'success', 'data'=> $events], 200);
    }
}
