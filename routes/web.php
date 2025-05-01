<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EducationalController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\MedHistoryController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\StudentApiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\ScfvController;
use App\Http\Controllers\SpreadsheetController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckCoordinatorOrAdmin;
use App\Http\Middleware\RestrictIPMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', RestrictIPMiddleware::class])->group(function () {

    // Start in:
    Route::get('/', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Login:
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Access:
    Route::get('/anamnesis/deposit', [MedHistoryController::class, 'deposit'])->name('anamnesis.deposit');
    Route::get('/attendance/deposit', [AttendanceController::class, 'deposit'])->name('attendance.deposit');
    Route::get('/educational/deposit', [EducationalController::class, 'deposit'])->name('educational.deposit');
    
    Route::resources([
        'anamnesis' => MedHistoryController::class,
        'attendance' => AttendanceController::class,
        'frequency' => FrequencyController::class,
        'educational' => EducationalController::class,
        'scfv' => ScfvController::class,
    ]);
    
    Route::get('/attendanceapi/detail', [AttendanceController::class, 'mudarSemana'])->name('attendance.weekChange');
    Route::post('/clear-session', [AttendanceController::class, 'clearSession'])->name('attendance.clearSession');

    Route::get('/student/deposit', [StudentApiController::class, 'deposit'])->name('student.deposit');
    Route::post('/student/restore/{id}', [StudentApiController::class, 'restore'])->name('student.restore');
    Route::post('/studentapi/{id}', [StudentApiController::class, 'archive'])->name('student.archive');
    Route::get('/student/anamnesis/{id}', [StudentController::class, 'showMedhistory'])->name('student.showMedhistory');
    Route::get('/student/attendance/{id}', [StudentController::class, 'showAttendancesAndFrequency'])->name('student.showAttendancesAndFrequency');
    Route::get('/student/educational/{id}', [StudentController::class, 'showEducationals'])->name('student.showEducationals');
    
    Route::resource('student', StudentController::class)->except('destroy');

    Route::post('/frequencies/multiple-details', [FrequencyController::class, 'updateDetails'])->name('frequency_details.update');
    Route::get('/studentapi/{id}', [StudentApiController::class, 'getStudentData']);

    // Export - User:
    Route::get('/export/educational/{id}', [EducationalController::class, 'generatePdf'])->name('educational.export');
    Route::get('/export/record/{id}', [RecordController::class, 'generatePdf'])->name('record.export');
    Route::get('/export/regional/{id}', [RegionalController::class, 'generatePdf'])->name('regional.export');
    Route::get('/export/scfv/{id}', [ScfvController::class, 'generatePdf'])->name('scfv.export');

    // Admin/Coordinator Access - Users List:
    Route::middleware(CheckCoordinatorOrAdmin::class)->group(function () {
        Route::post('/coordinator/archive/{id}', [CoordinatorController::class, 'archive'])->name('coordinator.archive');
        Route::get('/coordinator/deposit', [CoordinatorController::class, 'deposit'])->name('coordinator.deposit');
        Route::post('/coordinator/restore/{id}', [CoordinatorController::class, 'restore'])->name('coordinator.restore');
        
        Route::resources([
            'coordinator'=> CoordinatorController::class,
            'regional' => RegionalController::class,
            'record' => RecordController::class,
        ]);
    });

    // Admin Access:
    Route::middleware(CheckAdmin::class)->group(function () {
        Route::resources([
            'donation' => DonationController::class,
            'expense' => ExpenseController::class
        ]);
        Route::post('/validate-password', [AdminController::class, 'validatePassword']);

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index'); 
        Route::get('/admin/check', [AdminController::class, 'checkStudentsFrequenciesDonations'])->name('admin.check');
        Route::post('/admin/update-frequencies-donations', [AdminController::class, 'updateFrequenciesDonations'])->name('admin.update');
        Route::delete('/admin/delete-frequency/{studentId}', [AdminController::class, 'deleteFrequency']);
        Route::delete('/admin/delete-donation/{studentId}', [AdminController::class, 'deleteDonation']);
        // Export - Admin:
        Route::post('/export/expenses', [SpreadsheetController::class, 'exportExpenses'])->name('export.expenses');
        Route::post('/export/donations', [SpreadsheetController::class, 'exportDonations'])->name('export.donations');
        Route::post('/export/donationsPdf', [DonationController::class, 'generatePdf'])->name('donation.export');
    });

    // Not Found:
    Route::fallback(function () {
        return view('errors.404');
    });
});
require __DIR__ . '/auth.php';