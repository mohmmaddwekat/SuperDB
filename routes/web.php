<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DbController;
use App\Http\Controllers\importController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SqlController;
<<<<<<< HEAD
use App\Http\Controllers\UserController;
=======
use App\Http\Controllers\VersionControlController;
>>>>>>> 842c0e4f43264792f1a3469e5cb684431aa3253b
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

// Route::get('/', function () {
//     return view('users.index');
// })->middleware('locale')->name('main');

Route::group([
    'prefix' => '/',
    'as' => 'users.',
    'middleware' => 'locale'

], function () {

    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/store', [UserController::class, 'store'])->name('store');

    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/logout', [UserController::class, 'destroy'])->name('logout');

    Route::post('/', [UserController::class, 'storeLogin'])->name('store-login');
});



//Dashboard Controller
Route::group([
    'prefix' => '/',
    'as' => 'super-db.',
    'middleware' => 'locale'

], function () {
<<<<<<< HEAD
=======
    Route::get('/{id}', [JobController::class, 'index'])->name('index');
    Route::get('view-column/{name}/{id}', [JobController::class, 'viewColumn'])->name('view-column');
    Route::get('versionControl/{name}/{id}', [JobController::class, 'versionControl'])->name('versionControl');
>>>>>>> 842c0e4f43264792f1a3469e5cb684431aa3253b

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/locale/{lang}', [LangController::class, 'locale'])->name('locale');


    Route::group([
        'prefix' => '/jobs',
        'as' => 'jobs.',

    ], function () {
        Route::get('/{id}', [JobController::class, 'index'])->name('index');
        Route::get('view-column/{name}/{id}', [JobController::class, 'viewColumn'])->name('view-column');
        Route::delete('/delete-table/{id}/{name}', [JobController::class, 'deletTable'])->name('delete-table');
        Route::delete('/delete-column/{id}/{table}/{column}', [JobController::class, 'deletColumn'])->name('delete-column');
    });


    Route::group([
        'prefix' => '/import',
        'as' => 'import.',


    ], function () {
        Route::get('/{id}', [importController::class, 'index'])->name('index');
        Route::post('/{id}', [importController::class, 'add'])->name('add');
    });


    Route::group([
        'prefix' => '/db',
        'as' => 'db.',


    ], function () {

        Route::get('/export/{id}/{export}/{table?}', [DbController::class, 'export'])->name('export');
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


<<<<<<< HEAD
    ], function () {
=======
});
Route::group([
    'prefix' => '/versionControl',
    'as' => 'versionControl.',


], function () {

    Route::get('/{id}', [VersionControlController::class, 'index'])->name('index');
    Route::post('/{id}', [VersionControlController::class, 'store'])->name('store');
    Route::get('/{file}/{table}/{id}', [VersionControlController::class, 'update'])->name('update');

});
Route::group([
    'prefix' => '/connection',
    'as' => 'connection.',
>>>>>>> 842c0e4f43264792f1a3469e5cb684431aa3253b

        Route::get('/{id}', [SqlController::class, 'index'])->name('index');
        Route::post('/{id}', [SqlController::class, 'store'])->name('store');
    });
    Route::group([
        'prefix' => '/connection',
        'as' => 'connection.',


    ], function () {
        Route::get('/', [ConnectionController::class, 'index'])->name('index');
        Route::get('/delete/{id}', [ConnectionController::class, 'delete'])->name('delete');
        Route::post('/add/{id}', [ConnectionController::class, 'add'])->name('add');
    });


    //Role Controller
    Route::get('/roles/trash', [RoleController::class, 'trash'])->name('roles.trash');
    Route::group([
        'prefix' => '/roles',
        'as' => 'roles.',
    ], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });
    //abilities Controller
    Route::group([
        'prefix' => '/abilities',
        'as' => 'abilities.',
    ], function () {

        Route::get('/create/{role}', [AbilityController::class, 'create'])->name('create');
        Route::post('/{role}', [AbilityController::class, 'store'])->name('store');
        Route::get('/{role}', [AbilityController::class, 'edit'])->name('edit');
        Route::put('/{role}', [AbilityController::class, 'update'])->name('update');
    });
});
