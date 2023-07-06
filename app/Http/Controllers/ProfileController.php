<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Host;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\View\View;

class ProfileController extends Controller
{
    // Public profile 
    public function showPublicProfile($id, $hostId = null)
    {
        
        $user = User::findOrFail($id);
        $offers = [];

        if (!is_null($hostId)) {
            $host = Host::findOrFail($hostId); // Retrieve the host using the host ID
            $user = $host->user; // Retrieve the associated user
            $offers = Offer::where('host_id', $user->host->id)->get();
        }
    
        return view('profile.public-profile', [
            'user' => $user,
            'offers' => $offers,
        ]);
    }
    

    public function publicProfileEditForm()
    {
        $user = Auth::user();
 
        return view('public-profile-edit', [
            'user' => $user,
        ]);
    }

    public function updatePublicProfile(Request $request)
    {
        $user = Auth::user(); // Retrieve the authenticated user

        // Validate the form data
        $validatedData = $request->validate([
            'about_me' => 'nullable|string|max:500',
            'profile_pic' => 'nullable|image|max:2048', // Assuming the profile picture is uploaded as an image file
        ]);

        // Update the user's public profile customization
        $user->about_me = $validatedData['about_me'];

        if ($request->hasFile('profile_pic')) {
            $profilePic = $request->file('profile_pic');
            $filename = time() . '.' . $profilePic->getClientOriginalExtension();
            $profilePic->storeAs('public/profile_pics', $filename);
            $user->profile_pic = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Public profile customization updated successfully.');
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', [
            'user' => $user,
            'filename' => $user->identity_document, // Pass the filename to the view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        $user->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function verifyIdentity(Request $request)
    {        
        $user = $request->user();
        $user->identity_number = $request->input('identity_number');
        
        $identityDocument = $request->file('identity_document');
        if ($identityDocument) {
            $filename = Str::random(40) . '.' . $identityDocument->getClientOriginalExtension();
            $path = Storage::disk('identity_documents')->putFileAs('', $identityDocument, $filename);
            $user->identity_document = 'identity_documents/' . $filename;
            $user->setUploadedIdentityDocument(true);
        }
        
        $user->save();
    
        // Clear the verified identity status until manually verified by admin
        $user->identity_verified = false;
        $user->save();
    
        return redirect()->route('profile.edit')->with('status', 'Identity information updated successfully.');
    }
    

// public function deleteIdentityDocument(Request $request)
// {
//     $user = $request->user();

//     // Check if the file exists before attempting deletion
//     $filePath = $user->identity_document;
//     if (Storage::disk('identity_documents')->exists($filePath)) {
//         // Delete the identity document file
//         Storage::disk('identity_documents')->delete($filePath);
//     } else {
//         // Handle the case when the file does not exist
//         // For example, you can log an error or display a message to the user
//         return redirect()->route('profile.edit')->with('error', 'Identity document file not found.');
//     }

//     // Update the user's verification status and identity document details
//     $user->setVerifiedIdentity(false);
//     $user->setUploadedIdentityDocument(false);
//     $user->identity_document = null;
//     $user->save();

//     return redirect()->route('profile.edit')->with('status', 'Identity document deleted successfully.');
// }

    // private function maskIdentityNumber($identityNumber)
    // {
    //     if ($identityNumber) {
    //         $maskedNumber = str_repeat('*', strlen($identityNumber) - 4) . substr($identityNumber, -4);
    //         return chunk_split($maskedNumber, 4, ' ');
    //     }
    //     return '';
    // }

    public function showVerificationView()
    {
        $user = Auth::user();
        $maskedNumber = $this->getMaskedIdentityNumber();

        return view('verify-phone', compact('user', 'maskedNumber'));
    }



}
