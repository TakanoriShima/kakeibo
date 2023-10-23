<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\CategoriesController;

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
    return view('dashboard');
})->name('records.index');

//Route::post('/records/index', [RecordsController::class, 'scheduleGet'])->name('schedule-get');

require __DIR__.'/auth.php';


/*Route::get('/', [RecordsController::class, 'index']);*/

Route::group(['middleware' => ['auth']], function () {
    Route::resource('records', RecordsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('users', UsersController::class);
    Route::get('chart', [RecordsController::class, 'chartGet'])->name('records.chart');
    Route::get('get_data', [RecordsController::class, 'scheduleGet']);
    
});           