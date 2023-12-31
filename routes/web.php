<?php

use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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
    Route::post('/students/image', [StudentController::class, 'imageUpload'])->name('students.imageUpload');

    Route::post('/sendSms', [PhoneNumberController::class, 'sms'])->name('send.sms');
    Route::post('/checkingConfirmationNumber', [PhoneNumberController::class, 'checkingConfirmationNumber'])->name('checkingConfirmationNumber');
});



// Codes written below will be removed

Route::get('/sendSms', function(){
    return view('dashboard.test');
});