<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/admin/',[AuthController::class, 'adminLoginView'])->name('admin.login');
Route::get('/admin/processLogin',[AuthController::class, 'adminLogin'])->name('admin.processLogin');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware'=>'admin'], function () {
    Route::get('/main', [adminController::class, 'main'])->name('main');
    Route::get('/rekapTeam', [adminController::class, 'rekapTeam'])->name('rekapTeam');
    Route::post('/validasiBuktiTransfer/{id}', [AdminController::class, 'validasiBuktiTransfer'])->name('validasiBuktiTransfer');
});
// env :
// GOOGLE_REDIRECT = http://localhost:8000/admin/processLogin
// GOOGLE_CLIENT_ID = 253099323815-3c7jhdmos6qtve5l3js6frj73v6umq8j.apps.googleusercontent.com
// GOOGLE_CLIENT_SECRET = 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

