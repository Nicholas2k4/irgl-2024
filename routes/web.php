<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AuthMiddleware;
use Google\Service\Adsense\Row;

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

Route::get('/', function () {
    return view('homepage');
})->name('homepage');
Route::get('/homepage-pc', function () {
    return view('homepage-pc');
})->name('homepage.pc');

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', function () {
        return redirect('register/step-one');
    });
    Route::get('/register/step-one', 'showStepOne')->name('register.show.step.one');
    Route::post('/register/step-one', 'postStepOne')->name('register.post.step.one');
    Route::get('/register/step-two', 'showStepTwo')->name('register.show.step.two');
    Route::post('/register/step-two', 'postStepTwo')->name('register.post.step.two');
    Route::get('/register/step-three', 'showStepthree')->name('register.show.step.three');
    Route::post('/register/step-three', 'postStepthree')->name('register.post.step.three');
    Route::get('/register/step-four', 'showStepfour')->name('register.show.step.four');
    Route::post('/register/step-four', 'postStepfour')->name('register.post.step.four');
    Route::get('/register/complete', 'completeRegistration')->name('register.complete');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login-form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', [AuthController::class, 'adminLoginView'])->name('admin.login');
Route::get('/admin/processLogin', [AuthController::class, 'adminLogin'])->name('admin.processLogin');


Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/reschedule', [JadwalController::class, 'reschedule'])->name('jadwal.reschedule');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
});



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/main', [adminController::class, 'main'])->name('main');
    Route::get('/rekapTeam', [adminController::class, 'rekapTeam'])->name('rekapTeam');
    Route::post('/validasiBuktiTransfer/{id}', [AdminController::class, 'validasiBuktiTransfer'])->name('validasiBuktiTransfer');


    Route::get('/team/{id}', [TeamController::class, 'getTeamById']);
    Route::get('/jadwal', [JadwalController::class, 'main'])->name('jadwal.main');
    Route::get('/jadwal/input', [JadwalController::class, 'input'])->name('jadwal.input');
    Route::post('/jadwal/save', [JadwalController::class, 'adminStore'])->name('jadwal.save');
    Route::get('/jadwal/view/{id?}', [JadwalController::class, 'view'])->name('jadwal.view');
    Route::get('/jadwal/delete/{id}', [JadwalController::class, 'delete'])->name('jadwal.delete');
    Route::get('/jadwal/{jadwal_id}/teams', [JadwalController::class, 'getTeams'])->name('jadwal.teams');
    Route::post('/jadwal/approve/{id}', [JadwalController::class, 'approve'])->name('jadwal.approve');
    Route::post('/jadwal/reject/{id}', [JadwalController::class, 'reject'])->name('jadwal.reject');
    Route::get('/jadwal/reschedule-log', [JadwalController::class, 'rescheduleLog'])->name('jadwal.reschedLog');
});
// env :
// GOOGLE_REDIRECT = http://localhost:8000/admin/processLogin
// GOOGLE_CLIENT_ID = 253099323815-3c7jhdmos6qtve5l3js6frj73v6umq8j.apps.googleusercontent.com
// GOOGLE_CLIENT_SECRET = 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
