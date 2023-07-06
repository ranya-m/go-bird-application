<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioService
{
    public function sendMessage($to, $message)
{
    $accountSid = config('twilio.account_sid');
    $authToken = config('twilio.auth_token');
    $phoneNumber = config('twilio.phone_number');
    
    $client = new Client($accountSid, $authToken);

    try {
        $client->messages->create(
            $to,
            [
                'from' => $phoneNumber,
                'body' => $message,
            ]
        );
    } catch (\Exception $e) {
        Log::error('Twilio SMS Error: ' . $e->getMessage());
    }
}

}
