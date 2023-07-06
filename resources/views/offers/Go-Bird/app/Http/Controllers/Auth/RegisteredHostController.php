<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegisteredHostController extends Controller
{
    /**
     * Display the registration view.
     */

    // registration of a host account by a user : 
    public function render(Request $request)
    {
        return view('become-host');
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
            return redirect()->route('hostboard');
    }

}
