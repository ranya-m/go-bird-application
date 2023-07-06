<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function showVerifyIdentityForm($userId)
    {
        $user = User::findOrFail($userId);
        
        return view('admin.partials.verify-identity', compact('user'));
    }

    public function verifyIdentity(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Perform the verification process and update the user's verification status
        $user->hasVerifiedIdentity = true;
        $user->save();

        return redirect()->route('admin.identity.index')->with('success', 'User identity verified successfully.');
    }
}

