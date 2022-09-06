<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DataSensorController;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/data_sensor', [DataSensorController::class, 'index']);
Route::get('/store_detail', [DataSensorController::class, 'store']);
Route::get('/filterHari', [DataSensorController::class, 'filterHari']);
Route::get('/filterBulan', [DataSensorController::class, 'filterBulan']);

Route::get('/dashboard', [DataSensorController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
