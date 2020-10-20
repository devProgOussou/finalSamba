<?php

use Inertia\Inertia;
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
//     return view('welcome');
// });
// Route::get('/', 'User\UserController@annonce')->name('showMyPersonalAnnonce');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ROUTE FOR ADMIN RESOURCE
Route::namespace ('Admin')->group(function () {
	Route::resource('/admin', 'AdminController');
});

// ROUTE FOR MAKE ACTIVE OR UNACTIVE USER
Route::get('/admin/active', 'Admin\AdminController@active')->name('isActive.active');
Route::get('/admin/unactive', 'Admin\AdminController@unactive')->name('isActive.unactive');
Route::put('/admin/active/{id}', 'Admin\AdminController@makeactive')->name('makeactive');
Route::put('/admin/unactive/{id}', 'Admin\AdminController@makeunactive')->name('makeunactive');

// ROUTE FOR ADMIN TO SHOW COMPANIES
Route::get('/admin/showCompany', 'Admin\AdminController@showCompany')->name('showCompany');
Route::post('/admin/showCompany', 'Admin\AdminController@showCompany')->name('showCompany');

// ROUTE FOR ADMIN TO SHOW PERSONALS
Route::get('/admin/showUser', 'Admin\AdminController@showUser')->name('showUser');
Route::post('/admin/showUser', 'Admin\AdminController@showUser')->name('showUser');

// ROUTE FOR USER REGISTER TO COMPLETE HIS REGISTRATION
Route::get('/user/userRegister', 'User\UserController@userRegister')->name('userRegister');
Route::post('/user/userRegister/{id}', 'User\UserController@userRegister')->name('userRegister');

// ROUTE FOR USER TO UPDATE HIS DATA
Route::get('/user/updatePersonalData/{personals}', 'HomeController@updatePersonalData')->name('updatePersonalData');
Route::put('/user/updateData/{personals}', 'User\UserController@update')->name('updateData');

// ROUTE FOR COMPANIES TO COMPLETE HIS REGISTRATION
Route::get('/company/CompanyRegister', 'User\UserController@CompanyRegister')->name('CompanyRegister');
Route::post('/company/CompanyRegister/{id}', 'User\UserController@CompanyRegister')->name('CompanyRegister');

// ROUTE FOR CREATING ADVERTISEMENT
Route::get('/user/makeAdvertisement', 'User\UserController@makeAdvertisement')->name('makeAdvertisement');
Route::post('/user/makeAdvertisement', 'User\UserController@makeAdvertisement')->name('makeAdvertisement');

// ROUTE FOR SHOW ADVERTISEMENT TO HOMEPAGE
Route::get('/', 'AdvertisementController@annonce')->name('annonce');


// ROUTE FOR SHOW COMMANDE PAGE DIALOG
Route::get('/order/{id}', 'OrderController@showDeal')->name('showDeal');

// ROUTE FOR SHOW PAGE TO MAKE ADVERTISEMENTS
Route::get('/user/advertisementMaker', 'User\UserController@advertisementMaker')->name('advertisementMaker');

// ROUTE FOR USER DEACTIVE
Route::get('/error', 'User\UserController@submitContact')->name('submitContact');
Route::post('/error', 'User\UserController@submitContact')->name('submitContact');

// ROUTE FOR ARCHIVE POST
Route::get('/order/makeArchive', 'User\UserController@makeArchive')->name('makeArchive');
Route::get('/order/makeDearchive', 'User\UserController@makeDearchive')->name('makeDearchive');
Route::post('order/makeArchive/{id}', 'User\UserController@makeArchive')->name('makeArchive');
Route::post('/order/makeDearchive{id}', 'User\UserController@makeDearchive')->name('makeDearchive');

// ROUTE FOR MAKING ORDER
Route::get('/order/{id}', 'OrderController@makeOrder')->name('makeOrder');
Route::post('/order/{id}', 'OrderController@makeOrder')->name('makeOrder');

// ROUTE FOR SHOW DEAL
Route::get('/order/index/{id}', 'OrderController@showDeal')->name('showDeal');
// ROUTE FOR USER RESOURCE

//ROUTE FOR SENDING MESSAGE
Route::get('/order/chat', 'User\UserController@sendMessage')->name('sendMessage');
Route::post('/order/chat/{id}', 'User\UserController@sendMessage')->name('sendMessage');

//ROUTE FOR SHOW MESSAGES
Route::get('chat', 'User\UserController@showMessage')->name('showMessage');

// ROUTE FOR DELETE MESSAGE
Route::get('/chat/{id}', 'User\UserController@deleteMessage')->name('deleteMessage');

// ROUTE FOR MESSAGE RESPONSE
// Route::get('/chat/response/{id}', 'OrderController@response')->name('response');
// Route::post('/chat/response/{id}', 'OrderController@sendResponse')->name('sendResponse');

// ROUTE FOR DELETE USER POST
Route::post('/admin/user/{id}', 'Admin\AdminController@deleteUserPost')->name('deleteUserPost');

// ROUTE FOR SHOW MESSAGES CONTACT
Route::get('/contact', 'Admin\AdminController@showContactMessage')->name('showContactMessage');

Route::namespace ('User')->group(function () {
	Route::resource('/user', 'UserController');
});

Route::get('/chatter', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');


Route::get('/chatter', 'HomeController@show')->name('show');
Route::view('/chatter', 'chat')->middleware('auth')->name('show');
Route::resource('messages', 'MessageController')->only([
    'index',
    'store'
]);