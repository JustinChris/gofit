<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'home']);

Route::get('/login', [UserController::class, 'getLogin'])->name('login');
Route::post('/login', [UserController::class, 'postLogin']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/dashboard', [HomeController:: class, 'getDashboard']);

Route::middleware(['auth'])->group(function() {

});

Route::middleware('auth.kasir')->group(function() {
    Route::get('/members', [HomeController::class, 'getMembers']);
    Route::get('/members/print/{id}', [MemberController::class, 'getPrintCard']);
    
    Route::get('/members/add', [MemberController::class, 'getAddMembers']);
    Route::post('/members/add', [MemberController::class, 'postAddMembers']);
    Route::get('/members/delete/{id}', [MemberController::class, 'getDeleteMembers']);
    Route::get('/members/update/{id}', [MemberController::class, 'getUpdateMembers']);
    Route::post('/members/update/{id}', [MemberController::class, 'postUpdateMembers']);


    Route::get('/members/password/reset/{id}', [MemberController::class, 'getResetPassword']);
    Route::get('/members/membership/add/{id}', [MemberController::class, 'getMembership']);
    Route::post('/members/membership/add/{id}', [MemberController::class, 'postMembership']);
    Route::get('/members/receipt/membership/{id}',[ReceiptController::class, 'getPrintMembershipReceipt']);

    Route::get('/members/deposit/{id}', [MemberController::class, 'getMemberDeposit']);
    Route::post('/members/deposit/{id}', [MemberController::class, 'postMemberDeposit']);
    Route::get('/members/receipt/deposit/{id}',[ReceiptController::class, 'getPrintDepositReceipt']);

    Route::get('/members/class/{id}', [MemberController::class, 'getMemberClass']);
    Route::post('/members/class/{id}', [MemberController::class, 'postMemberClass']);
    Route::get('/members/receipt/class/{id}',[ReceiptController::class, 'getPrintClassReceipt']);

});


Route::middleware('auth.admin')->group(function() {
    Route::get('/instructors', [HomeController::class, 'getInstructors']);
    Route::get('/instructors/add', [InstructorController::class, 'getAddInstructors']);
    Route::post('/instructors/add', [InstructorController::class, 'postAddInstructors']);
    Route::get('/instructors/delete/{id}', [InstructorController::class, 'getDeleteInstructors']);
    Route::get('/instructors/update/{id}', [InstructorController::class, 'getUpdateInstructors']);
    Route::post('/instructors/update/{id}', [InstructorController::class, 'postUpdateInstructors']);
});

Route::middleware('auth.mo')->group(function() {
    Route::get('/schedule', [HomeController::class, 'getSchedule']);
    Route::get('/schedule/add', [ScheduleController::class, 'getAddSchedule']);
    Route::post('/schedule/add', [ScheduleController::class, 'postAddSchedule']);
    Route::get('/schedule/delete/{id}', [ScheduleController::class, 'getDeleteSchedule']);
    Route::get('/schedule/update/{id}', [ScheduleController::class, 'getUpdateSchedule']);
    Route::post('/schedule/update/{id}', [ScheduleController::class, 'postUpdateSchedule']);
    Route::get('/schedule/update/status/{id}', [ScheduleController::class, 'getChangeScheduleToHoliday']);

    Route::post('/schedule/check/add', [ScheduleController::class, 'postCheckAvailibilty']);

    Route::get('/schedule/generate', [ScheduleController::class, 'getGenerateDailySchedule']);
});