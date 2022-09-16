<?php

use App\Http\Controllers\home;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin;
use App\Http\Controllers\Authuser;
use App\Http\Controllers\user;

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

Route::get('/', [home::class, 'home']);


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/postlogin', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {


    Route::prefix('admin')->middleware('can:admin')->group(function () {
        //dasbord
        Route::get('/dashboard', [admin::class, 'dashboard']);
        Route::get('/background-image/create', [admin::class, 'background_create']);
        Route::post('/background-image/store', [admin::class, 'background_store']);
        Route::delete('/background-image/delete/{id}', [admin::class, 'background_destroy']);
        Route::put('/background-image/update/{id}', [admin::class, 'background_update']);
        Route::get('/author', [admin::class, 'authoradmin']);
        Route::get('/prodi', [admin::class, 'prodiadmin']);
        Route::get('/type', [admin::class, 'typeadmin']);
        Route::get('/repository', [admin::class, 'repoadmin']);
        //repository
        Route::get('/tambahrepository', [admin::class, 'tambahrepo']);
        Route::post('/tambahrepository/create', [admin::class, 'store']);
        Route::get('/deleterepository/delete/{id}', [admin::class, 'deleterepo']);
        Route::get('/editrepository/edit/{id}', [admin::class, 'editrepo']);
        Route::post('/editrepository/update/{id}', [admin::class, 'updaterepo']);
        //author
        Route::get('/tambahauthor', [admin::class, 'formauthor']);
        Route::post('/tambahauthor/create', [admin::class, 'tambahauthor']);
        Route::get('/deleteauthor/delete/{id}', [admin::class, 'deleteauthor']);
        Route::get('/editauthor/edit/{id}', [admin::class, 'editauthor']);
        Route::post('/editauthor/update/{id}', [admin::class, 'updateauthor']);
        //prodi
        Route::get('/tambahprodi', [admin::class, 'formprodi']);
        Route::post('/tambahprodi/create', [admin::class, 'tambahprodi']);
        Route::get('/deleteprodi/delete/{id}', [admin::class, 'deleteprodi']);
        Route::get('/editprodi/edit/{id}', [admin::class, 'editprodi']);
        Route::post('/editprodi/update/{id}', [admin::class, 'updateprodi']);
        //type
        Route::get('/tambahtype', [admin::class, 'formtype']);
        Route::post('/tambahtype/create', [admin::class, 'tambahtype']);
        Route::get('/deletetype/delete/{id}', [admin::class, 'deletetype']);
        Route::get('/edittype/edit/{id}', [admin::class, 'edittype']);
        Route::post('/edittype/update/{id}', [admin::class, 'updatetype']);
        //edit password
        Route::get('/editpassword/edit', [AuthController::class, 'editpassword']);
        Route::post('/editpassword/update', [AuthController::class, 'updatepassword'])->name('updatepassword');
    });
});


Route::get('/loginuser', [Authuser::class, 'index'])->name('loginuser');
Route::post('/postloginuser', [Authuser::class, 'login']);
Route::get('/logoutuser', [Authuser::class, 'logout'])->name('logoutuser');




Route::prefix('user')->middleware('user')->group(function () {
    //dasbord
    Route::get('/dashboard', [user::class, 'dashboarduser'])->name('user');
    Route::get('/author', [user::class, 'authoruser']);
    Route::get('/prodi', [user::class, 'prodiuser']);
    Route::get('/type', [user::class, 'typeuser']);
    Route::get('/repository', [user::class, 'repouser']);
    Route::get('/title', [user::class, 'title']);
    Route::get('/single/{id}', [user::class, 'single']);
    //author
    Route::get('/tambahauthor', [user::class, 'formauthor']);
    Route::post('/tambahauthor/create', [user::class, 'tambahauthor']);
    Route::get('/singleAuthor/{id}', [user::class, 'singleAuthor']);

    // prodi
    Route::get('/tambahprodi', [user::class, 'formprodi']);
    Route::post('/tambahprodi/create', [user::class, 'tambahprodi']);
    Route::get('/singleProdi/{id}', [user::class, 'singleProdi']);
    //type
    Route::get('/tambahtype', [user::class, 'formtype']);
    Route::post('/tambahtype/create', [user::class, 'tambahtype']);
    Route::get('/singleType/{id}', [user::class, 'singleType']);
    //repo
    Route::get('/tambahrepository', [user::class, 'tambahrepo']);
    Route::post('/tambahrepository/create', [user::class, 'store']);
});
