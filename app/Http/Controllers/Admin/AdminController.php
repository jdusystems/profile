<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AdminController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();
        $phoneNumbersCount = Student::whereNotNull('phone_number')->count();
        $contactNumbersCount = Student::whereNotNull('contact_number')->count();

        // Getting counts of images on storage/images folder
        $imagesCount = count(Storage::files('public/images'));

        return view('admin.index', [
            'studentsCount' => $studentsCount,
            'phoneNumbersCount' => $phoneNumbersCount,
            'contactNumbersCount' => $contactNumbersCount,
            'imagesCount' => $imagesCount,
        ]);
    }
    public function students()
    {
        $students = Student::all();
        return view('admin.students', ['students' => $students]);
    }
    public function images()
    {
        return view('admin.images');
    }

    public function downloadImages()
    {
        return [
            "wala" => "wala"
        ];
    }
}
