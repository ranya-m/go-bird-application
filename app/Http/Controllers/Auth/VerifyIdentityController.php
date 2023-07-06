<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use App\Http\Requests\IdentityVerificationRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VerifyIdentityController extends Controller
{
    /**
     * Mark the authenticated user's Identity as verified.
     */
    public function verifyIdentity(Request $request): RedirectResponse
    {
        $user = $request->user();

        $verificationStatus = $request->input('verification_status');

        $user->markIdentityAsVerified($verificationStatus === 'verified');

        $flashMessage = $verificationStatus === 'verified' ? 'Identity verified successfully.' : 'Identity verification declined.';
        Session::flash('success', $flashMessage);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function showIdentityDocument($filename)
    {

        $user = Auth::user();
        if ($user->identity_document && $filename === $user->identity_document || $user->isAdmin()) {
            $filePath = Storage::disk('identity_documents')->path($filename);
            return Response::file($filePath);
        }

    }

    public function sendIdentityVerification(IdentityVerificationRequest $request)
    {
        $user = $request->user();

        // Perform the identity verification process

        // Update the identity_verified column value
        $user->identity_verified = true;
        $user->identity_verified_at = Carbon::now();
        $user->save();

        // Set session variable to indicate verification success
        Session::flash('status', 'identity-verification-request-sent');

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
