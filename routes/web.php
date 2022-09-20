<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\KindOfRoomController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
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

Auth::routes(['logout' => false,'register'=>false]);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', function () {return redirect()->route('home');});
Route::group(['prefix' => 'admin', 'middleware' => 'role:admin,staff'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //RoomType
    Route::group(['prefix' => 'roomtype'], function () {
        Route::get('/index', [RoomTypeController::class, 'index'])->name('admin.roomtype.index');
        Route::get('/dt-row-data', [RoomTypeController::class, 'getDtRowData']);
        Route::post('/createRoomType', [RoomTypeController::class, 'create'])->name('admin.roomtype.createRoomType');
        Route::get('/update/{id}', [RoomTypeController::class, 'edit'])->name('admin.roomtype.update');
        Route::post('/update/{id}', [RoomTypeController::class, 'update']);
        Route::get('/delete/{id}', [RoomTypeController::class, 'delete'])->name('admin.roomtype.delete');
        Route::get('/unactive-roomtype/{id}', [RoomTypeController::class, 'unactive_roomtype'])->name('admin.roomtype.unactive_roomtype');
        Route::get('/active-roomtype/{id}', [RoomTypeController::class, 'active_roomtype'])->name('admin.roomtype.active_roomtype');
    });

    //KindOfRoom
    Route::group(['prefix' => 'kindofroom'], function () {
        Route::get('/index', [KindOfRoomController::class, 'index'])->name('admin.kindofroom.index');
        Route::get('/dt-row-data', [KindOfRoomController::class, 'getDtRowData']);
        Route::post('/createKindofRoom', [KindOfRoomController::class, 'create'])->name('admin.kindofroom.createKindofRoom');
        Route::get('/update/{id}', [KindOfRoomController::class, 'edit'])->name('admin.kindofroom.update');
        Route::post('/update/{id}', [KindOfRoomController::class, 'update']);
        Route::get('/delete/{id}', [KindOfRoomController::class, 'delete'])->name('admin.kindofroom.delete');
        Route::get('/unactive-kindofroom/{id}', [KindOfRoomController::class, 'unactive_kindofroom'])->name('admin.kindofroom.unactive_kindofroom');
        Route::get('/active-kindofroom/{id}', [KindOfRoomController::class, 'active_kindofroom'])->name('admin.kindofroom.active_kindofroom');
    });

    //Room
    Route::group(['prefix' => 'room'], function () {
        Route::get('/index', [RoomController::class, 'index'])->name('admin.room.index');
        Route::get('/dt-row-data', [RoomController::class, 'getDtRowData']);
        Route::get('/create', [RoomController::class, 'create'])->name('admin.room.create');
        Route::post('/create', [RoomController::class, 'saveroom'])->name('admin.room.store');
        Route::get('/update/{id}', [RoomController::class, 'edit'])->name('admin.room.update');
        Route::post('/update/{id}', [RoomController::class, 'update']);
        Route::get('/delete/{id}', [RoomController::class, 'delete'])->name('admin.room.delete');
        Route::get('/unactive-room/{id}', [RoomController::class, 'unactive_room'])->name('admin.room.unactive_room');
        Route::get('/active-room/{id}', [RoomController::class, 'active_room'])->name('admin.room.active_room');
        Route::get('/listRoom/{id}', [RoomController::class, 'listRoomByRoomType'])->name('admin.room.listRoom.index');
        Route::get('/listRoom/{id}/dt-row-data', [RoomController::class, 'getDtRowDataByRoomType']);
        Route::get('/listRoomByKindOfRoom/{id}', [RoomController::class, 'listRoomByKindOfRoom'])->name('admin.room.listRoomByKindOfRoom.index');
        Route::get('/listRoomByKindOfRoom/{id}/dt-row-data', [RoomController::class, 'getDtRowDataByKindOfRoom']);
    });

});
Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
    Route::group(['prefix' => 'account'], function () {
        Route::get('/index', [AccountController::class, 'index'])->name('admin.account.index');
        Route::get('/dt-row-data', [AccountController::class, 'getDtRowData']);
        Route::post('/create', [AccountController::class, 'create']);
        Route::get('/update/{id}', [AccountController::class, 'edit'])->name('admin.account.update');
        Route::post('/update/{id}', [AccountController::class, 'update']);
        Route::get('/delete/{id}', [AccountController::class, 'delete'])->name('admin.account.delete');
        Route::get('/unban-account/{id}', [AccountController::class, 'unlock_account'])->name('admin.account.unban_account');
        Route::get('/ban-account/{id}', [AccountController::class, 'lock_account'])->name('admin.account.ban_account');
    });
});

Route::get('/bookingRoom',[HomeController::class,'booking_room']);
Route::get('/detailRoom/{id}',[HomeController::class,'detail_room']);
Route::post('/save-cart', [CartController::class,'save_cart']);
Route::get('/show-cart', [CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class,'delete_cart']);
Route::post('/update-cart', [CartController::class,'update_cart']);

//Register the controller
Route::get('/loginCustomer', [RegisterController::class, 'login_user']);
Route::get('/registerAccount', [RegisterController::class, 'register_user'])->name('register');
Route::post('/createUserAccount', [RegisterController::class, 'create']);
Route::post('/loginCustomer',[RegisterController::class,'customer_login'])->name('loginCustomer');

//facebook loginCustomer 
Route::get('/facebook/login',[RegisterController::class,'login_facebook'])->name('login_facebook');
Route::get('/facebook/callback',[RegisterController::class,'callback_facebook']);

//google loginCustomer

Route::get('/google/login',[RegisterController::class,'login_google'])->name('login_google');
Route::get('/google/callback',[RegisterController::class,'callback_google']);


Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/save-checkout',[CheckoutController::class,'save_checkout']);
Route::get('/payment',[CheckoutController::class,'payment']);
Route::post('/order-place',[CheckoutController::class,'order_place']);
Route::post('/add-booking-ajax',[CartController::class,'add_booking_ajax']);

Route::get('/admin/manager-booking', [AdminController::class, 'manager_booking'])->name('admin.managerBooking.index');
Route::get('/admin/booking/dt-row-data', [AdminController::class, 'getDtRowData']);
Route::get('/admin/manager-booking/detail/{id}', [AdminController::class, 'detail_booking'])->name('admin.managerBooking.detail');
Route::get('/admin/booking/detail/dt-row-data', [AdminController::class, 'getDtRowDataDetail']);

//edit profile

Route::get('/profile-account', [UserController::class, 'index'])->name('user.profile');
Route::post('/', [UserController::class, 'uploadAvatar'])->name('user.uploadAvatar');
Route::get('/phone/update', [UserController::class, 'changePhoneNumber']);
Route::post('/phone/update', [UserController::class, 'changePhoneNumber'])->name('user.phone.update');
Route::get('/password/edit', [UserController::class, 'changePassword']);
Route::post('/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');

Route::get('/show-roomtype/{roomtype_id}', [RoomTypeController::class,'show_roomtype']);
Route::get('/show-kindofroom/{kindofroom_id}', [KindOfRoomController::class,'show_kindofroom']);

Route::get('/contactUs',[ContactController::class,'index']);
Route::post('/sendContact',[ContactController::class,'send_contact'])->name('contact');
Route::get('/send_email',[ContactController::class,'send_email']);
Route::get('/customer/activeAccount/{user}/{token}',[RegisterController::class,'active_account'])->name('customer.activeAccount');

