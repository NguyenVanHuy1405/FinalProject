<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\KindOfRoomController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AccountController;
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

Auth::routes(['logout' => false]);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', function () {return redirect()->route('home');});

Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');

Route::post('/admin/login',[AdminController::class,'login_post']);
Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');


Route::get('/admin/room/index', [RoomController::class,'index'])->name('admin.room.index');
Route::get('/admin/room/dt-row-data',[RoomController::class,'getDtRowData']);
Route::get('/admin/room/create', [RoomController::class, 'create'])->name('admin.room.create');
Route::post('/admin/room/create', [RoomController::class, 'saveroom'])->name('admin.room.store');
Route::get('/admin/room/update/{room_id}', [RoomController::class, 'edit'])->name('admin.room.update');
Route::post('/admin/room/update/{room_id}', [RoomController::class, 'update']);
Route::get('/admin/room/delete/{room_id}', [RoomController::class, 'delete'])->name('admin.room.delete');
Route::get('/unactive-room/{room_id}',[RoomController::class,'unactive_room'])->name('admin.room.unactive_room');
Route::get('/active-room/{room_id}',[RoomController::class,'active_room'])->name('admin.room.active_room');
Route::get('/listRoom/{id}',[RoomController::class,'listRoomByRoomType'])->name('admin.room.listRoom.index');

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin,staff'], function () {
    Route::group(['prefix'=>'roomtype'],function(){
        Route::get('/index', [RoomTypeController::class,'index'])->name('admin.roomtype.index');
        Route::get('/dt-row-data',[RoomTypeController::class,'getDtRowData']);
        Route::post('/createRoomType', [RoomTypeController::class, 'create'])->name('admin.roomtype.createRoomType');
        Route::get('/update/{id}', [RoomTypeController::class, 'edit'])->name('admin.roomtype.update');
        Route::post('/update/{id}', [RoomTypeController::class, 'update']);
        Route::get('/delete/{id}', [RoomTypeController::class, 'delete'])->name('admin.roomtype.delete');
        Route::get('/unactive-roomtype/{id}',[RoomTypeController::class,'unactive_roomtype'])->name('admin.roomtype.unactive_roomtype');
       Route::get('/active-roomtype/{id}',[RoomTypeController::class,'active_roomtype'])->name('admin.roomtype.active_roomtype');   
    });
    Route::group(['prefix'=>'kindofroom'],function(){
        Route::get('/index',[KindOfRoomController::class,'index'])->name('admin.kindofroom.index');
        Route::get('/dt-row-data',[KindOfRoomController::class,'getDtRowData']);
        Route::post('/createKindofRoom', [KindOfRoomController::class, 'create'])->name('admin.kindofroom.createKindofRoom');
        Route::get('/update/{id}', [KindOfRoomController::class, 'edit'])->name('admin.kindofroom.update');
        Route::post('/update/{id}', [KindOfRoomController::class, 'update']);
        Route::get('/delete/{id}', [KindOfRoomController::class, 'delete'])->name('admin.kindofroom.delete');
        Route::get('/unactive-kindofroom/{id}',[KindOfRoomController::class,'unactive_kindofroom'])->name('admin.kindofroom.unactive_kindofroom');
        Route::get('/active-kindofroom/{id}',[KindOfRoomController::class,'active_kindofroom'])->name('admin.kindofroom.active_kindofroom');

    });

});

Route::get('/admin/account/index',[AccountController::class,'index'])->name('admin.account.index');
Route::get('/admin/account/dt-row-data',[AccountController::class,'getDtRowData']);
Route::post('/admin/account/create', [AccountController::class, 'create']);
Route::get('/admin/account/update/{id}', [AccountController::class, 'edit'])->name('admin.account.update');
Route::post('/admin/account/update/{id}', [AccountController::class, 'update']);
Route::delete('/admin/account/delete/{id}', [AccountController::class, 'delete'])->name('admin.account.delete');
Route::get('/unban-account/{id}',[AccountController::class,'unactive_kindofroom'])->name('admin.account.unban_account');
Route::get('/ban-account/{id}',[AccountController::class,'active_kindofroom'])->name('admin.account.ban_account');