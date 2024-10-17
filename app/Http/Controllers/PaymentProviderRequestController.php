<?php

namespace App\Http\Controllers;

use App\Models\PaymentProviderRequest;
use App\Models\Event;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Mail\PaymentProviderRequestNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class PaymentProviderRequestController extends Controller
{

    public function index()
    {
        $paymentProviderRequests = PaymentProviderRequest::where('status', 'pending')->get();
        return view('finance.approveRequests', compact('paymentProviderRequests'));
    }


    public function create()
    {
        // Fetch events and companies for the form
        $events = Event::all();
        $companies = Company::all();

        // Return the form view with events and companies
        return view('finance.requestPaymentProvider', compact('events', 'companies'));
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'payment_method_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'event_id' => 'required|exists:events,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        // Create the payment provider request
        $paymentProviderRequest = PaymentProviderRequest::create([
            'payment_method_name' => $request->payment_method_name,
            'website' => $request->website,
            'event_id' => $request->event_id,
            'company_id' => $request->company_id,
            'status' => 'pending',  // Initially, all requests will have a pending status
        ]);
        $users = User::where('role', "admin")->get();
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new PaymentProviderRequestNotification($paymentProviderRequest));
        }
        
        return redirect()->route('finance.dashboard')->with('success', 'Payment provider request submitted successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $paymentProviderRequest = PaymentProviderRequest::findOrFail($id);
        $paymentProviderRequest->update([
            'status' => $request->status,
        ]);

        
        $users = User::where('role', "finance")->get();
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new PaymentProviderRequestNotification($paymentProviderRequest, true));
        }
        return redirect()->route('finance.dashboard')->with('success', 'Payment provider request status updated.');
    }
}
