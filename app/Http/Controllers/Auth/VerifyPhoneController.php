<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\Message\Message;

class VerifyPhoneController extends Controller
{
    public function verifyPhone(Request $request)
    {
        $phoneNumber = $request->input('phone');
        $verificationCode = $request->input('verification_code');

        $user = Auth::user();

        // Redirect user if the phone number is already verified
        if ($user->hasVerifiedPhone()) {
            return redirect()->route('home')->with('message', 'Phone number already verified.');
        }

        // Generate a verification code
        $smsVerificationCode = $this->generateVerificationCode();

        // Save the verification code to the user's record in the database
        $user->verification_code = $verificationCode;
        $user->save();

        // Send SMS message with the verification code
        $to = $phoneNumber;
        $message = 'Your verification code is: ' . $verificationCode;
        $this->sendSMS($to, $message);

        // Validate the verification code
        if ($this->validateVerificationCode($verificationCode)) {
            return redirect()->route('home')->with('message', 'Valid verification code. Phone verified successfully.');
        }

        return redirect()->back()->with('error', 'Invalid verification code.');
    }

    private function validateVerificationCode($smsVerificationCode)
    {
        $user = Auth::user();

        // Check if the verification code is valid
        if ($smsVerificationCode === $user->verification_code) {
            // Mark the phone as verified
            $user->markPhoneAsVerified();
            return true;
        } else {
            return false;
        }
    }

    private function generateVerificationCode()
    {
        // random 4-digit verification code
        return str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    private function sendSMS($to, $message)
    {
        $basicAuth = new Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $client = new Client($basicAuth);

        $response = $client->message()->send([
            'to' => $to,
            'from' => env('VONAGE_PHONE_NUMBER'),
            'text' => $message
        ]);


        if ($response->getMessages()[0]['status'] == 0) {
            session()->flash('success', 'SMS sent successfully!');
        } else {
            session()->flash('error', 'Failed to send SMS. Please try again.');
        }
    }
}


