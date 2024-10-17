<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Company;
use App\Models\EventPayment;
use Illuminate\Http\Request;
use App\Mail\PaymentConfiguredNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('finance.dashboard', compact('events'));
    }

    public function editPayment($eventId)
    {
        $event = Event::findOrFail($eventId);
        $paymentMethods = PaymentMethod::all();
        $companies = Company::all();
        $eventPayment = EventPayment::where('event_id', $event->id)->first();

        return view('finance.editPayment', compact('event', 'paymentMethods', 'companies', 'eventPayment'));
    }

    public function updatePayment(Request $request, $eventId)
    {
        $validated = $request->validate([
            'payment_method' => 'required',
            'vat_rate' => 'required|numeric',
            'company' => 'required',
        ]);

        $eventPayment = EventPayment::updateOrCreate(
            ['event_id' => $eventId],
            [
                'payment_method_id' => $request->payment_method,
                'company_id' => $request->company,
                'vat_rate' => $request->vat_rate,
            ]
        );
        $event = Event::findOrFail($eventId);
        Mail::to(Auth::user()->email)->send(new PaymentConfiguredNotification($event));
        return redirect()->route('finance.dashboard')->with('success', 'Payment updated successfully.');
    }
}
