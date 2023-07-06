<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredHostController extends Controller
{

    // registration of a host account by a user : 
    public function render(Request $request)
    {
        $user = Auth::user();
        return view('profile.become-host', ['user' => $user]);
        
    }

    public function create(Request $request) 
    {
        $user = Auth::user();
        
        $request->validate([
            'agree_to_host_terms' => 'required|boolean',
        ]);

            $user->host()->create([
                'user_id' => $user->id,
                'agree_to_host_terms' => $request->input('agree_to_host_terms', true),
                'account_approved' => false,
            ]);
            
            // Redirect to the host dashboard blade 
            return Redirect::route('host.dashboard');
       
    }

}
