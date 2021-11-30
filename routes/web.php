<?php

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\DbController;
use App\Http\Controllers\importController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LangController;
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

Route::get('{locale}/', function () {
    return view('welcome');
})->middleware('locale');


//Dashboard Controller
Route::group([
    'prefix' => '{locale}/jobs',
    'as' => 'jobs.',
    'middleware' => ['locale']
    
], function () {
    Route::get('/{id}', [JobController::class, 'index'])->name('index');
    Route::get('view-column/{name}/{id}', [JobController::class, 'viewColumn'])->name('view-column');

    Route::delete('/delete-table/{id}/{name}', [JobController::class, 'deletTable'])->name('delete-table');

    Route::delete('/delete-column/{id}/{table}/{column}', [JobController::class, 'deletColumn'])->name('delete-column');



});



Route::get('import/{id}', [importController::class, 'index'])->name('import.index');
Route::post('import/add/{id}', [importController::class, 'add'])->name('import.add');

Route::group([
    'prefix' => '{locale}/db',
    'as' => 'db.',
    'middleware' => ['locale']

], function () {

    Route::get('/export/{id}/{export}/{table?}', [DbController::class, 'export'])->name('export');
});

Route::group([
    'prefix' => '{locale}/inserts',
    'as' => 'inserts.',
    'middleware' => ['locale']

], function () {
    Route::get('/{id}', [InsertController::class, 'index'])->name('index');
    Route::post('/{id}', [InsertController::class, 'store'])->name('store');

    Route::get('/rename-column/{id}/{table}/{column}', [InsertController::class, 'renameColumn'])->name('rename-column');
    Route::post('/rename-column/{id}/{table}/{column}', [InsertController::class, 'updateColumn'])->name('update-column');

    Route::get('/rename-table/{id}/{table}', [InsertController::class, 'renameTable'])->name('rename-table');
    Route::post('/rename-table/{id}/{table}', [InsertController::class, 'updateTable'])->name('updateTable');
});
Route::group([
    'prefix' => '{locale}/sqls',
    'as' => 'sqls.',
    'middleware' => ['locale']

], function () {

    Route::get('/{id}', [SqlController::class, 'index'])->name('index');
    Route::post('/{id}', [SqlController::class, 'store'])->name('store');

});
Route::group([
    'prefix' => '{locale}/connection',
    'as' => 'connection.',
    'middleware' => ['locale']

], function () {
    Route::get('/', [ConnectionController::class, 'index'])->name('index');
    Route::get('/delete/{name}', [ConnectionController::class, 'delete'])->name('delete');
    Route::post('/add/{id}', [ConnectionController::class, 'add'])->name('add');
});



