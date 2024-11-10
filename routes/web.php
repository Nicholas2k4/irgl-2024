<?php

use Spatie\FlareClient\View;
use Google\Service\Adsense\Row;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FinalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InputScoreTeamController;
use App\Http\Controllers\LockController;
use App\Http\Middleware\ClosedMiddleware;
use App\Http\Middleware\CryptoMiddleware;

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

// Route::get('/', function () {
//     return view('homepage');
// })->name('homepage');
// Route::get('/homepage-hp', function () {
//     return view('homepage-hp');
// })->name('homepage.hp');

Route::get('/', function(){
    return redirect()->route('sponsor');
})->name('homepage');

Route::get('/dummy', function(){
    return view('sponsor');
})->name('sponsor');


/**
 * Routes for registration
 */
Route::controller(RegisterController::class)->middleware([ClosedMiddleware::class])->group(function () {
    Route::get('/register', function () {
        return redirect('register/step-one');
    })->name('register');
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
    Route::get('/info', [InfoController::class, 'userIndex'])->name('info');

    /**
     * Routes for semifinal
     */
    Route::prefix('semifinal')->group(function () {
        Route::get('/', [NewsController::class, 'semifinalHome'])->name('semifinal.home');
        Route::get('/news', [NewsController::class, 'semifinalNews'])->name('semifinal.news');
        Route::get('/inventory', [NewsController::class, 'semifinalInventory'])->name('semifinal.inventory');
    });

    /**
     * Routes for final
     */
    Route::prefix('final')->group(function () {
        Route::get('/game1', [FinalController::class, 'game1'])->name('final.game1');
        Route::get('/game2', [FinalController::class, 'game2'])->name('final.game2');
        Route::get('/game3', [FinalController::class, 'game3'])->middleware([CryptoMiddleware::class])->name('final.game3');

        Route::post('/game1/{id}', [FinalController::class, 'storeLogicAnswer'])->name('final.game1.store');
        Route::post('/game2/store', [FinalController::class, 'storeDecode'])->name('final.game2.store');
    });
});



/**
 * Routes for admin
 */

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/main', [adminController::class, 'main'])->name('main');
    Route::get('/rekapTeam', [adminController::class, 'rekapTeam'])->name('rekapTeam');
    Route::get('/leaderboards', [adminController::class, 'leaderboards'])->name('leaderboards');
    Route::get('/leaderboard-semi', [adminController::class, 'leaderboardSemi'])->name('leaderboard.semi');
    Route::get('/player-semi', [AdminController::class, 'playerSemi'])->name('playerSemi');
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

    Route::get('/market', [MarketController::class, 'index'])->name('market');
    Route::post('/market', [MarketController::class, 'store'])->name('market.store');
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::post('/news/skipNews', [NewsController::class, 'skipNews'])->name('news.skipNews');

    Route::get('/inputscoreteam', [InputScoreTeamController::class, 'showForm'])->name('inputscoreteam');
    Route::post('/inputscoreteam', [InputScoreTeamController::class, 'addScore'])->name('inputscoreteam.addscore');

    Route::get('/infos', [InfoController::class, 'index'])->name('infos.index');
    Route::get('/infos/create', [InfoController::class, 'create'])->name('infos.create');
    Route::post('/infos', [InfoController::class, 'store'])->name('infos.store');
    Route::get('/infos/edit/{id}', [InfoController::class, 'edit'])->name('infos.edit');
    Route::put('/infos/{id}', [InfoController::class, 'update'])->name('infos.update');
    Route::delete('/infos/{id}', [InfoController::class, 'destroy'])->name('infos.destroy');

    Route::get('/generate-dummy-teams', [TeamController::class, 'generateDummyTeams']);
    Route::get('/reset', [JadwalController::class, 'reset'])->name('reset');
    Route::post('/reset', [JadwalController::class, 'resetPost'])->name('resetgame-team');
    Route::put('/resetschedule', [JadwalController::class, 'resetSchedule'])->name('resetgame-schedule');

    Route::get('/clue', [FinalController::class, 'clue'])->name('clue');
    Route::post('/clue', [FinalController::class, 'buyClue'])->name('buyClue');

    Route::get('/lock', [LockController::class, 'index'])->name('lock.index');
    Route::get('/lock2', [LockController::class, 'index2'])->name('lock2.index');
    Route::post('/lock', [LockController::class, 'store'])->name('lock.store');
    Route::post('/lock2', [LockController::class, 'store2'])->name('lock2.store');
});
