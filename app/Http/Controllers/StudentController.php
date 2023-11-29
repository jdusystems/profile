<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student_id = $request->student_id;
        $student = Student::where('student_id', $student_id)->firstOrFail();
        return view('dashboard.profile', ['student' => $student]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student)
    {
        $student->update([
            'student_id' => $request->student_id,
            'surname' => $request->surname,
            'given_name' => $request->given_name,
            'phone_number' => $request->phone_number,
            'contact_number' => $request->contact_number
        ]);
        return view('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function imageUpload(Request $request)
    {


        $imageDataUrl = $request->input('image');
        $studentId = $request->input('studentId');

        // return response()->json(['result' => $imageDataUrl]);





        // Decode the data URL and save the image
        list($type, $data) = explode(';', $imageDataUrl);
        list(, $data)      = explode(',', $data);
        $decodedImage = base64_decode($data);      
        
        // Save the image to a storage location
        $imageName = $studentId . '.png';
        try {
            if (!file_exists(public_path("images/"))) {
                mkdir(public_path("images/"), 666, true);
            }
            file_put_contents(public_path("images/" . $imageName), $decodedImage);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $e->getMessage(),
            ], 422);
        }

        // You can save the image information to the database if needed

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'imageName' => $imageName
        ]);
    }
}
