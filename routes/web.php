<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::post('/jobs/feature-query', [JobController::class, 'storeFeature'])->name('jobs.store-feature');

    //Dashboard Controller
    Route::group([
        'prefix' => '/jobs',
        'as' => 'jobs.',
    ], function () {
        Route::get('/', [JobController::class, 'index'])->name('index');
        Route::post('/', [JobController::class, 'store'])->name('store');
        Route::get('/feature-query', [JobController::class, 'featureQuery'])->name('feature-query');
        Route::get('/import', [JobController::class, 'import'])->name('import');
        Route::post('/store-import', [JobController::class, 'storeImport'])->name('store-import');
    });

Route::prefix('connection')->group(function () {
Route::get('/',[ConnectionController::class,'index']);
Route::get('/delete/{name}',[ConnectionController::class,'delete']);
Route::post('/add/{id}', [ConnectionController::class, 'add']);
});



