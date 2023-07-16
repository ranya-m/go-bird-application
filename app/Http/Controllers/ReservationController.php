<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class ReservationController extends Controller
{
    public function create($offerId)
{
    // Retrieve the offer
    $offer = Offer::findOrFail($offerId);

    // Calculate the initial values
    $startDate = request()->input('start_date') ?? now()->toDateString();
    $endDate = request()->input('end_date') ?? now()->addDay()->toDateString();
    // $pricePerNight = $offer->price;
    // $numberOfNights = Carbon::parse($startDate)->diffInDays($endDate);
    // $totalPrice = $pricePerNight * $numberOfNights;

    // Other necessary data for the view
    $unavailableDates = Reservation::getUnavailableDates($offer->id);
    $encUnavailableDates = json_encode($unavailableDates);

    return view('reservations.create', [
        'offer' => $offer,
        'startDate' => $startDate,
        'endDate' => $endDate,
        // 'pricePerNight' => $pricePerNight,
        // 'numberOfNights' => $numberOfNights,
        // 'totalPrice' => $totalPrice,
        'encUnavailableDates' => $encUnavailableDates,
    ]);
}



        public function store(Request $request, Reservation $reservation)
    {
        $request->validate([
            'offer_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $offerId = $request->input('offer_id');
        $offer = Offer::findOrFail($offerId);

    

        // Create the reservation
        $reservation = Reservation::create([
            'offer_id' => $offerId,
            'user_id' => auth()->user()->id,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        // Update offer availability based on reservation status
        if ($reservation->status === 'accepted') {
            $offer->update(['available' => false]);
        }

        return redirect()->route('traveler.dashboard')->with('success', 'Reservation requested successfully.');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $request->validate([
        'start_date' => 'date',
        'end_date' => 'date|after:start_date',
    ]);

    $reservation->update([
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
    ]);

    // Manage the request for cancel :
    if ($request->has('cancel')) {
        return $this->cancelReservation($reservation);
    }

    return redirect()->route('traveler.dashboard')->with('success', 'Reservation updated successfully.');
}

    
    // CANCELLATION SYSTEM : 
    public function cancelReservation(Reservation $reservation)
    {
        $startDateTime = new DateTime($reservation->start_date);
        $endDateTime = new DateTime($reservation->end_date);
        $currentDateTime = new DateTime();
        $cancellationFee = 0;

        if ($currentDateTime > $endDateTime) {
            // Reservation has already ended
            $cancellationFee = $this->calculateFee($startDateTime, $endDateTime);
        } elseif ($currentDateTime >= $startDateTime) {
            // Reservation is currently ongoing
            $cancellationFee = $this->calculateFee($currentDateTime, $endDateTime);
        }

        // Perform the cancellation logic here, update the reservation status, etc.
        $reservation->status = 'canceled';
        $reservation->save();

        // Set the offer availability back to true if the status was pending
        if ($reservation->status === 'pending' || $reservation->status === 'canceled' ) {
            $reservation->offer->available = true;
            $reservation->offer->save();
        }

        // Display the cancellation message with the fee
        $cancellationMessage = 'Reservation canceled successfully.';
        if ($cancellationFee > 0) {
            $cancellationMessage .= ' Cancellation fee: ' . $cancellationFee . ' USD.';
        }

        Session::flash('cancellationMessage', $cancellationMessage); 

        return redirect()->route('traveler.dashboard');

    }


    // Function to calculate cancellation fee based on the dates
    function calculateFee(DateTime $from, DateTime $to)
    {
        $interval = $to->diff($from);
        $days = $interval->days;

        if ($days >= 48) {
            // More than 48 hours before check-in
            $cancellationFee = $days * 0.25; // 25% of the reservation amount
        } else {
            // Less than 48 hours before check-in
            $cancellationFee = $days * 0.5; // 50% of the reservation amount
        }

        return $cancellationFee;
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Check if reservation is canceled by user or status is pending
        if ($reservation->status === 'pending' || $reservation->isCanceledByUser()) {
            $offer = $reservation->offer;
            $offer->update(['available' => true]);
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }

}

