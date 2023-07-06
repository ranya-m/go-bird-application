<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class HostDashboardController extends Controller
{
    public function index()
    {
        

        return view('dashboard.host', [
            
        ]);
        // $host = Auth::user()->host;
        // $offers = $host->offers()->pluck('id');
        // $allReservations = Reservation::whereIn('offer_id', $offers)
        //     ->orderByDesc('created_at')
        //     ->get();

        // return view('dashboard.host', [
        //     'reservations' => $allReservations,
        // ]);
        
        // $host = Auth::user()->host;
        // $offers = $host->offers()->pluck('id');
        // $recentReservations = Reservation::whereIn('offer_id', $offers)
        //     ->orderByDesc('created_at')
        //     ->take(3)
        //     ->get();

        // return view('dashboard.host', [
        //     'recentReservations' => $recentReservations,
        // ]);
    }

        public function acceptReservation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId)::with('user');
        $reservation->status = 'accepted';
        $reservation->save();

        // Flash message to indicate the reservation acceptance, to be displayed in the traveler's dashboard
        session()->flash('reservationAccepted', 'Your reservation has been accepted by the host.');

        return redirect()->back()->with('success', 'Reservation accepted successfully.');
    }

    public function declineReservation($reservationId)
    {
        // $reservation = Reservation::findOrFail($reservationId);
        $reservation = Reservation::findOrFail($reservationId)::with('user');

        $reservation->status = 'declined';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation declined successfully.');
    }

    public function pendingReservations()
    {
        // $reservations = Reservation::where('status', 'pending')->get();
        $reservations = Reservation::where('status', 'pending')::with('user');


        return view('dashboard.host-pending-reservations', ['pendingReservations' => $reservations,
        
    ]);
    }

    public function ongoingAcceptedReservations()
    {
        $today = now()->toDateString();
    
        // $reservations = Reservation::where('status', 'accepted')
        //     ->whereDate('start_date', '<=', $today)
        //     ->whereDate('end_date', '>=', $today)
        //     ->get();
        $reservations = Reservation::where('status', 'accepted')
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->get()::with('user');

            

    
        return view('dashboard.host-ongoing-accepted-reservations', ['ongoingAcceptedReservations' => $reservations,
        
        ]);
    }
    

    public function futureAcceptedReservations()
    {
        $today = now()->toDateString();


        // $reservations = Reservation::where('status', 'accepted')
        //     ->whereDate('start_date', '>', $today)
        //     ->get();

        $reservations = Reservation::with('user')
        ->where('status', 'accepted')
        ->whereDate('start_date', '>', $today)
        ->get();

        return view('dashboard.host-future-accepted-reservations', ['futureAcceptedReservations' => $reservations,
        
        ]);
    }


    public function reservationsHistory()
    {
        $reservations = Reservation::with('user')
    ->where('end_date', '<', now())
    ->get();


        return view('dashboard.host-reservations-history', ['reservationsHistory' => $reservations,
        
        
    ]);
    }


    public function allReservations()
    {
        $host = Auth::user()->host;
        $offers = $host->offers()->pluck('id');
        $allReservations = Reservation::whereIn('offer_id', $offers)
            ->orderByDesc('created_at')
            ->get()::with('user');

        return view('dashboard.host-reservations', [
            'reservations' => $allReservations,            
        ]);
    }
}


