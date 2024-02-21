<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PhoneNumberController extends Controller
{
    public function sms(Request $request)
    {
        // return response()->json(['success' => "Successfully"], 200);
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

    public function checkingConfirmationNumber(Request $request)
    {
        // Validation rules
        $rules = [
            'studentId' => ['required', 'exists:students,student_id'],
            'phoneNumber' => ['required', 'size:12'],
            'sms' => ['required'],
            'isParentsPhone' => ['required', 'boolean']   // if this is true phoneNumber is parent's otherwise Student's phone number
        ];

        // Custom error messages
        $messages = [
            'phoneNumber.required' => 'Telefon raqamini kiritish shart.',
            'phoneNumber.max' => "Telefon raqamini formati noto'g'ri.",
            'sms.required' => 'Tasdiqlash kodini kiriting.',
            // Add custom messages for other rules...
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return JSON response with errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (PhoneNumber::where('phone_number', $request->phoneNumber)->first()) {
            $phoneNumber = PhoneNumber::where('phone_number', $request->phoneNumber)->first();
            if ($phoneNumber->message == $request->sms) {
                $student = Student::where('student_id' ,$request->studentId)->first();
                if ($request->isParentsPhone) {
                    $student->contact_number = $request->phoneNumber;
                } else {
                    $student->phone_number = $request->phoneNumber;
                }
                $student->save();
                // Removing row from phone_numbers table
                PhoneNumber::where('phone_number', $request->phoneNumber)->delete();

                return response()->json(['status' => 'success', 'message' => 'Telefon raqami tasdiqlandi!'], 200);
            } else {
                return response()->json(['status' => 'error', 'error' => "Tasdiqlash kodi noto'g'ri"], 422);
            }
        } else {
            return response()->json(['status' => 'error', 'error' => "Telefon raqamni qayta kiriting"], 404);
            // Record does not exist
        }

        return response()->json($request);
    }
}
