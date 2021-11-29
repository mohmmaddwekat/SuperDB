<?php

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\DbController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SqlController;
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


//Dashboard Controller
Route::group([
    'prefix' => '/jobs',
    'as' => 'jobs.',
    
], function () {
    Route::get('/{id}', [JobController::class, 'index'])->name('index');
    Route::get('view-column/{name}/{id}', [JobController::class, 'viewColumn'])->name('view-column');

    Route::delete('/delete-table/{id}/{name}', [JobController::class, 'deletTable'])->name('delete-table');

    Route::delete('/delete-column/{id}/{table}/{column}', [JobController::class, 'deletColumn'])->name('delete-column');



});

Route::get('import/{id}', [importController::class, 'index'])->name('import.index');
Route::post('import/add/{id}', [importController::class, 'add'])->name('import.add');

Route::group([
    'prefix' => '/db',
    'as' => 'db.',
    
], function () {

    Route::get('/export/{id}/{table?}', [DbController::class, 'export'])->name('export');
});

Route::group([
    'prefix' => '/inserts',
    'as' => 'inserts.',
    
], function () {
    Route::get('/{id}', [InsertController::class, 'index'])->name('index');
    Route::post('/{id}', [InsertController::class, 'store'])->name('store');

    Route::get('/rename-column/{id}/{table}/{column}', [InsertController::class, 'renameColumn'])->name('rename-column');
    Route::post('/rename-column/{id}/{table}/{column}', [InsertController::class, 'updateColumn'])->name('update-column');

    Route::get('/rename-table/{id}/{table}', [InsertController::class, 'renameTable'])->name('rename-table');
    Route::post('/rename-table/{id}/{table}', [InsertController::class, 'updateTable'])->name('updateTable');
});
Route::group([
    'prefix' => '/sqls',
    'as' => 'sqls.',
    
], function () {

    Route::get('/{id}', [SqlController::class, 'index'])->name('index');
    Route::post('/{id}', [SqlController::class, 'store'])->name('store');

});
Route::group([
    'prefix' => '/connection',
    'as' => 'connection.',
], function () {
    Route::get('/', [ConnectionController::class, 'index'])->name('index');
    Route::get('/delete/{name}', [ConnectionController::class, 'delete'])->name('delete');
    Route::post('/add/{id}', [ConnectionController::class, 'add'])->name('add');
});



