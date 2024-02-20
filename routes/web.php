<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Resources\ParentResourceCollection;
use App\Models\Student;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Begins here

Route::middleware('auth')->group(function () {
    Route::get('/', function(){
        return view('dashboard.index');
    });
    Route::resource('/students', StudentController::class);
    Route::post('/student/image', [StudentController::class, 'imageUpload'])->name('students.imageUpload');

    Route::post('/sendSms', [PhoneNumberController::class, 'sms'])->name('send.sms');
    Route::post('/checkingConfirmationNumber', [PhoneNumberController::class, 'checkingConfirmationNumber'])->name('checkingConfirmationNumber');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/students', [AdminController::class, 'students'])->name('students');
        Route::get('/images', [AdminController::class, 'images'])->name('images');
        Route::get('/downloadImages', [AdminController::class, 'downloadImages'])->name('downloadImages');
    });


    // Test route for getting data from database
    Route::get('/data-to-parents', function(){
        return new ParentResourceCollection(Student::all());
    });
});
