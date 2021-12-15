<?php

use App\Http\Controllers\UsersPermissionsController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SqlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionControlController;
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


Route::post('log',[UserController::class, 'destroy'])->name('log');

//Dashboard Controller
Route::group([
    'prefix' => '/',
    'as' => 'super-db.',
    'middleware' => 'locale'

], function () {


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
        Route::get('versionControl/{name}/{id}', [JobController::class, 'versionControl'])->name('versionControl');

    });


    Route::group([
        'prefix' => '/import',
        'as' => 'import.',


    ], function () {
        Route::get('/{id}', [ImportController::class, 'index'])->name('index');
        Route::post('/{id}', [ImportController::class, 'add'])->name('add');
    });


    Route::group([
        'prefix' => '/db',
        'as' => 'db.',


    ], function () {

        Route::get('/export/{id}/{export}/{table?}', [ExportController::class, 'export'])->name('export');
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

        Route::get('/add-row/{table}/{connection_id}', [InsertController::class, 'addRow'])->name('add-row');
        Route::post('/store-row/{table}/{connection_id}', [InsertController::class, 'storeRow'])->name('store-row');

    });
    Route::group([
        'prefix' => '/sqls',
        'as' => 'sqls.',

    ], function () {


        Route::get('/{id}', [SqlController::class, 'index'])->name('index');
        Route::post('/{id}', [SqlController::class, 'store'])->name('store');
    
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


    ], function () {
        Route::get('/', [ConnectionController::class, 'index'])->name('index');
        Route::get('/delete/{id}', [ConnectionController::class, 'deleteDBConnection'])->name('delete');
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
    //permissions Controller
    Route::group([
        'prefix' => '/permissions',
        'as' => 'permissions.',
    ], function () {

        Route::get('/create/{role}', [UsersPermissionsController::class, 'createUserRole'])->name('create');
        Route::post('/{role}', [UsersPermissionsController::class, 'store'])->name('store');
        Route::get('/{role}', [UsersPermissionsController::class, 'editRolePermissions'])->name('edit');
        Route::put('/{role}', [UsersPermissionsController::class, 'updateUserRole'])->name('update');
    });
});
