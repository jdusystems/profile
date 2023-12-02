<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PhoneNumberController extends Controller
{
    public function sms(Request $request)
    {
        // Phone number
        // Generating message
        $request->validate([
            'phone_number' => ['required', 'max:12']
        ]);
        $randomNumber = rand(1000, 9999);
        PhoneNumber::UpdateOrCreate(
            [
                'phone_number' => $request->phone_number
            ],
            [
                'phone_number' => $request->phone_number,
                'message' => $randomNumber
            ]
        );

        // Replace this with your actual JSON payload
        // Phone number should be 998999905518 this kind of format
        $jsonPayload = '{
            "messages": [
                {
                    "recipient": "' . $request->phone_number . '",
                    "message-id": "ress12345",
                    "sms": {
                        "originator": "3700",
                        "content": {
                            "text": "Tasdiqlash kodi: ' . $randomNumber . '"
                        }
                    }
                }
            ]
        }';

        // Replace these values with your actual authentication credentials and post data
        $username = env('SMS_CLIENT_USERNAME');
        $password = env('SMS_CLIENT_PASSWORD');
        $url = env('SMS_SERVICE_URL');

        try {
            Http::withBody($jsonPayload)->withBasicAuth($username, $password)->withHeaders([
                'headers' => [
                    'Accept' => 'application/json'
                ],
            ])->post($url);

            // Process the response data as needed

            return response()->json(['message' => "SMS muvaffaqiyatli jo'natildi", 'status_code' => 200]);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
