<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;


class TravelerDashboardController extends Controller
{
    public function index()
    {
        // $notifications = $user->notifications()->latest()->limit(10)->get();
        $user = auth()->user();

        $reservations = $user->reservations()->with('offer.host.user')->get();

        return view('dashboard.traveler', [
            'reservations' => $reservations,  
        // 'notifications' => $notifications,
        ]);
    }

    public function reservationsRequests()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->with('offer.host')->get();
    
        // Retrieve the cancellation message from the session
        $cancellationMessage = Session::get('cancellationMessage');
    
        // Retrieve already confirmed stays to exclude them from the requests list
        $confirmedStays = $user->reservations()->where('status', 'confirmed')->get();
    
        // Load the host relationship for each offer
        foreach ($reservations as $reservation) {
            $reservation->offer->load('host');
            
        }

        
    
        return view('dashboard.traveler-reservations-requests', [
            'reservations' => $reservations,
            'cancellationMessage' => $cancellationMessage,
            'reservationAccepted' => $user->reservations()->where('status', 'accepted')->exists(),
            'confirmedStays' => $confirmedStays,
        ]);
    }
    

    public function checkoutForm($reservationId) 
    {
        $reservation = Reservation::findOrFail($reservationId);
        $amount = $reservation->offer->price * $reservation->numberOfNights();
    
        // Load the host relationship for the offer
        $reservation->offer->load('host');
    
        return view('reservations.checkout-form', [
            'reservation' => $reservation,
            'amount' => $amount,
            'host' => $reservation->offer->host, // Pass the host to the view
        ]);
    }
    

    public function confirmPayStay(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

                // Validate the payment information
                $request->validate([
                    'customer_name' => 'required',
                    'card_number' => 'required',
                ]);
        
                // Create a new payment record
                $payment = new Payment();
                $payment->reservation_id = $reservation->id;
                $payment->customer_name = $request->input('customer_name');
                $payment->card_number = $request->input('card_number');
                $payment->amount = $reservation->offer->price * $reservation->numberOfNights();
                $payment->save();
        
        // Update the reservation status and set the confirmed flag to true
        $reservation->status = 'confirmed';
        $reservation->confirmed = true;
        $reservation->save();

        // Check if the reservation has passed its end date
        if (Carbon::parse($reservation->end_date)->isPast()) {
            return redirect()->route('traveler.past-stays');
        }

        // Redirect the user to a thank you page or appropriate page
        return redirect()->route('traveler.thankyou');
    }

    public function confirmedStays()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->with('offer.host')->get();
    
        $confirmedStays = $user->reservations()
            ->where('status', 'confirmed')
            ->whereDate('end_date', '>=', now())
            ->get();
    
        // Load the host relationship for each offer
        foreach ($confirmedStays as $reservation) {
            $reservation->offer->load('host');
        }
    
        return view('dashboard.traveler-confirmed-stays', [
            'confirmedStays' => $confirmedStays,
            'reservations' => $reservations,
        ]);
    }
    

    public function pastStays()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->with('offer.host')->get();
    
        $pastStays = $user->reservations()
            ->where('status', 'confirmed')
            ->whereDate('end_date', '<', now())
            ->get();
    
        // Load the host relationship for each offer
        foreach ($pastStays as $reservation) {
            $reservation->offer->load('host');
        }
    
        return view('dashboard.traveler-past-stays', [
            'pastStays' => $pastStays,
            'reservations' => $reservations,
        ]);
    }
    

}
