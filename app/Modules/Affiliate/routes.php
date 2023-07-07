<?php


Route::group(['module' => 'Affiliate', 'prefix' => 'Affiliate','middleware' => ['web'],'namespace' => 'App\Modules\Affiliate\Controllers'], function() {

    Route::get('/', array('as' => 'affiliate.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::get('/signin', array('as' => 'affiliate.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::post('/signin', array('as' => 'affiliate.signin' ,'uses' => 'LoginController@signin'));
    Route::get('/forgot_password', array('as' => 'affiliate.forgot_password' ,'uses' => 'LoginController@showForgotPasswordForm'));
    Route::post('/forgot_password', array('as' => 'affiliate.forgot_password' ,'uses' => 'LoginController@forgot_password'));
    Route::get('/reset_password/{token?}', array('as' => 'affiliate.reset_password' ,'uses' => 'LoginController@showResetPasswordForm'));
    Route::post('/reset_password', array('as' => 'affiliate.reset_password' ,'uses' => 'LoginController@reset_password'));
    Route::get('/signout', array('as' => 'affiliate.signout' ,'uses' => 'LoginController@signout'));

});


// Admin password protected routes
Route::group(['module' => 'Affiliate', 'prefix' => 'Affiliate','middleware' => ['web','affiliate'],'namespace' => 'App\Modules\Affiliate\Controllers'], function() {

    // Dashboard Routes
    Route::get('/dashboard', array('as' => 'affiliate.dashboard' ,'uses' => 'DashboardController@index'));
    
    Route::get('/entitieslist',array('as' => 'affiliate.entitieslist' , 'uses'=>'EntitiesListController@index'));
    Route::get('/ledger',array('as' => 'affiliate.ledger' , 'uses'=>'LedgerController@ledgerView'));
    Route::get('/ledger_details/action', 'LedgerController@ledgerDetails')->name('ledger_details.action');

});
