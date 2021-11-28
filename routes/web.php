<?php

use App\Http\Controllers\ConnectionController;
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

Route::post('/jobs/insert/{id}', [JobController::class, 'storeInsert'])->name('jobs.store-insert');

//Dashboard Controller
Route::group([
    'prefix' => '/jobs',
    'as' => 'jobs.',
    
], function () {
    Route::get('/{id}', [JobController::class, 'index'])->name('index');
    Route::get('view-column/{name}/{id}', [JobController::class, 'viewColumn'])->name('view-column');

    Route::get('/sql/{id}', [JobController::class, 'sql'])->name('sql');

    Route::post('/{id}', [JobController::class, 'store'])->name('store');
    Route::get('/insert/{id}', [JobController::class, 'insert'])->name('insert');
    Route::get('/import', [JobController::class, 'import'])->name('import');
    Route::post('/store-import', [JobController::class, 'storeImport'])->name('store-import');
});


Route::group([
    'prefix' => '/connection',
    'as' => 'connection.',
], function () {
    Route::get('/', [ConnectionController::class, 'index'])->name('index');
    Route::get('/delete/{name}', [ConnectionController::class, 'delete'])->name('delete');
    Route::post('/add/{id}', [ConnectionController::class, 'add'])->name('add');
});



