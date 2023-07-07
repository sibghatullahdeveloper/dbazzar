<?php

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


Route::get('/', array('as' => 'home', 'uses'=> 'HomeController@index'));
Route::get('/live_search/action', 'HomeController@browseEntityBranchAction')->name('live_search.action');
Route::get('/live_search/sponsoredAction', 'HomeController@sponsoredAction')->name('live_search.sponsoredAction');

Route::get('/EntityBranch/{slug?}', array('as'=> 'entity' , 'uses' => 'EntityController@index'));
Route::get('/browse', array('as' => 'browse', 'uses'=> 'HomeController@browseEntityBranch'));
Route::get('/EntityBranchList', array('as' => 'EntityBranchList', 'uses'=> 'HomeController@EntityBranchData'));

Route::post('/AddItemTocart', array('as'=> 'addItemTocart' , 'uses' => 'CheckoutController@addItemTocart'));
Route::post('/increaseQuantity' , array('as' => 'increaseQuantity' , 'uses' => 'CheckoutController@increaseQuantity'));
Route::post('/dcreaseQuantity', array('as' => 'dcreaseQuantity' , 'uses' => 'CheckoutController@dcreaseQuantity'));
Route::get('/guestCheckout', array('as' => 'guestCheckout' , 'uses' => 'CheckoutController@showcheckoutform'));
Route::post('/removeItem' , array('as' => 'removeItem' ,'uses' => 'CheckoutController@removeItem'));
Route::post('/placeorder' , array('as' => 'placeOrder' , 'uses' => 'CheckoutController@placeyourOrder'));
Route::get('/signup', array('as'=> 'signup' , 'uses' => 'CheckoutController@showcheckoutOptions'));
Route::get('/signin', array('as'=> 'signin' , 'uses' => 'CheckoutController@showcheckoutOptions'));
Route::post('/register' , array('as' => 'register' , 'uses' => 'LoginController@signupsignup'));
Route::get('/confirm/{token?}', array('as' => 'confirm' ,'uses' => 'LoginController@confirm'));
Route::post('/login', array('as' => 'login', 'uses'=>'LoginController@signin'));
Route::get('/signout', array('as' => 'signout' ,'uses' => 'LoginController@signout'));
Route::get('/forgot_password', array('as' => 'forgot_password_form' ,'uses' => 'LoginController@showForgotPasswordForm'));
Route::post('/forgot_password', array('as' => 'forgot_password', 'uses'=>'LoginController@forgot_password'));
Route::get('/reset_password/{token?}', array('as' => 'reset_password' ,'uses' => 'LoginController@showResetPasswordForm'));
Route::post('/reset_password_store', array('as' => 'reset_password_store', 'uses'=>'LoginController@reset_password'));


Route::post('/edit_password/{id?}', array('as' => 'edit_password', 'uses'=>'UserController@editPassword'));
Route::post('/edit_profile/{id?}', array('as' => 'edit_profile', 'uses'=>'UserController@editProfile'));

Route::get('login/{provider}', 'LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback');
Route::get('/createCheckout', array('as' => 'createCheckout', 'uses' =>'CheckoutController@showcheckoutOptions'));
//Route::post('/emptyCart' , array('as' => 'emptycart', 'uses' => 'CheckoutController@emptyTheCart'));
Route::get('/saveVoucher/{voucher?}/{user_id?}', array('as' => 'saveVoucher' ,'uses' => 'LoginController@saveVoucher'));
Route::group(['middleware' => ['web','customer']], function() {


Route::get('/userCheckout', array('as' => 'Checkout' , 'uses' => 'CheckoutController@showcheckoutuser'));
Route::post('/placeuserOrder' , array('as' => 'placeuserOrder' , 'uses' => 'CheckoutController@placeUserOrder'));
Route::post('/applyvoucher' , array('as' =>'applyvoucher' , 'uses' => 'CheckoutController@applyvoucher'));
Route::get('/myorders',array('as' =>'myorders','uses' => 'CheckoutController@MyOrders'));
Route::get('/myaccount',array('as'=>'myaccount' , 'uses' => 'UserController@index'));
});
