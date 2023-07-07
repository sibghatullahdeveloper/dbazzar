<?php


Route::group(['module' => 'Entity', 'prefix' => 'Entity','middleware' => ['web'],'namespace' => 'App\Modules\Entity\Controllers'], function() {

    Route::get('/', array('as' => 'entity.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::get('/signin', array('as' => 'entity.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::post('/signin', array('as' => 'entity.signin' ,'uses' => 'LoginController@signin'));
    Route::get('/forgot_password', array('as' => 'entity.forgot_password' ,'uses' => 'LoginController@showForgotPasswordForm'));
    Route::post('/forgot_password', array('as' => 'entity.forgot_password' ,'uses' => 'LoginController@forgot_password'));
    Route::get('/reset_password/{token?}', array('as' => 'entity.reset_password' ,'uses' => 'LoginController@showResetPasswordForm'));
    Route::post('/reset_password', array('as' => 'entity.reset_password' ,'uses' => 'LoginController@reset_password'));
    Route::get('/signout', array('as' => 'entity.signout' ,'uses' => 'LoginController@signout'));

});


// Entity password protected routes
Route::group(['module' => 'Entity', 'prefix' => 'Entity','middleware' => ['web','entity'],'namespace' => 'App\Modules\Entity\Controllers'], function() {

    // Dashboard Routes
    Route::get('/dashboard', array('as' => 'entity.dashboard' ,'uses' => 'DashboardController@index'));

    //Entity Routes
    Route::get('/EntityInfo', array('as' => 'entity.entityInfo' ,'uses' => 'EntityController@index'));
      Route::get('/AddNewEntityBranch/{uuid?}', array('as' => 'entity.AddEntityBranch' ,'uses' => 'EntityController@ViewAddForm'));
      Route::get('/viewEnityBranches/{uuid?}', array('as' => 'entity.entityBranch' ,'uses' => 'EntityController@ViewEntityBranches'));
       Route::post('/SaveEntityBranch', array('as' => 'entity.saveEntityBranch' ,'uses' => 'EntityController@saveEntityBranchdata'));
    
    //Product Categories Routes
    Route::get('/productcategory', array('as' => 'entity.productcategory' ,'uses' => 'ProductCategoryController@index'));
    Route::get('/createproductcategory', array('as' => 'entity.createproductcategory' ,'uses' => 'ProductCategoryController@create'));
    Route::POST('/storeproductcategory', array('as' => 'entity.storeproductcategory' ,'uses' => 'ProductCategoryController@store'));
    Route::get('/editproductcategory/{uuid}', array('as' => 'entity.editproductcategory' ,'uses' => 'ProductCategoryController@edit'));
    Route::patch('/updateproductcategory/{id}', array('as' => 'entity.updateproductcategory' ,'uses' => 'ProductCategoryController@update'));
    Route::get('/deleteproductcategory/{id}', array('as' => 'entity.deleteproductcategory' ,'uses' => 'ProductCategoryController@delete'));


    //Food Items Routes
    Route::get('/fooditems', array('as' => 'entity.fooditems' ,'uses' => 'FoodItemsController@index'));
    Route::get('/createfooditems', array('as' => 'entity.createfooditems' ,'uses' => 'FoodItemsController@create'));
    Route::POST('/storefooditems', array('as' => 'entity.storefooditems' ,'uses' => 'FoodItemsController@store'));
    Route::get('/editfooditems/{uuid}', array('as' => 'entity.editfooditems' ,'uses' => 'FoodItemsController@edit'));
    Route::patch('/updatefooditems/{id}', array('as' => 'entity.updatefooditems' ,'uses' => 'FoodItemsController@update'));
    Route::get('/deletefooditems/{id}', array('as' => 'entity.deletefooditems' ,'uses' => 'FoodItemsController@delete'));
    //Product variations

   //Add Ons Routes
    Route::get('/addons', array('as' => 'entity.addons' ,'uses' => 'AddOnsController@index'));
    Route::get('/createaddons', array('as' => 'entity.createaddons' ,'uses' => 'AddOnsController@create'));
    Route::POST('/storeaddons', array('as' => 'entity.storeaddons' ,'uses' => 'AddOnsController@store'));
    Route::get('/editaddons/{uuid}', array('as' => 'entity.editaddons' ,'uses' => 'AddOnsController@edit'));
    Route::patch('/updateaddons/{id}', array('as' => 'entity.updateaddons' ,'uses' => 'AddOnsController@update'));
    Route::get('/deleteaddons/{id}', array('as' => 'entity.deleteaddons' ,'uses' => 'AddOnsController@delete'));


    //Add Ons Category Routes
    Route::get('/addonscategory', array('as' => 'entity.addonscategory' ,'uses' => 'AddOnsCategoryController@index'));
    Route::get('/createaddonscategory', array('as' => 'entity.createaddonscategory' ,'uses' => 'AddOnsCategoryController@create'));
    Route::POST('/storeaddonscategory', array('as' => 'entity.storeaddonscategory' ,'uses' => 'AddOnsCategoryController@store'));
    Route::get('/editaddonscategory/{uuid}', array('as' => 'entity.editaddonscategory' ,'uses' => 'AddOnsCategoryController@edit'));
    Route::patch('/updateaddonscategory/{id}', array('as' => 'entity.updateaddonscategory' ,'uses' => 'AddOnsCategoryController@update'));
    Route::get('/deleteaddonscategory/{id}', array('as' => 'entity.deleteaddonscategory' ,'uses' => 'AddOnsCategoryController@delete'));

    //entity branch settings
     Route::get('/entity_settings', array('as' => 'entity.entity_settings' ,'uses' => 'EntitiesSettingsController@index'));
    Route::get('/entity_settings_create', array('as' => 'entity.entity_settings_create' ,'uses' => 'EntitiesSettingsController@create'));
    Route::POST('/entity_settings_add', array('as' => 'entity.entity_settings_create_add' ,'uses' => 'EntitiesSettingsController@store'));
    Route::get('/entity_settings_edit/{id}', array('as' => 'entity.entity_settings_edit' ,'uses' => 'EntitiesSettingsController@entity_settings_edit'));
    Route::get('/entity_settings_delete/{id}', array('as' => 'entity.entity_settings_delete' ,'uses' => 'EntitiesSettingsController@entity_settings_delete'));


    //E-Voucher Routes
    Route::get('/evouchers', array('as' => 'entity.evouchers' ,'uses' => 'EvoucherController@index'));
    Route::get('/createevouchers', array('as' => 'entity.createevouchers' ,'uses' => 'EvoucherController@create'));
    Route::POST('/storeevouchers', array('as' => 'entity.storeevouchers' ,'uses' => 'EvoucherController@store'));
    Route::get('/editevouchers/{uuid}', array('as' => 'entity.editevouchers' ,'uses' => 'EvoucherController@edit'));
    Route::patch('/updateevouchers/{id}', array('as' => 'entity.updateevouchers' ,'uses' => 'EvoucherController@update'));
    Route::get('/deleteevouchers/{id}', array('as' => 'entity.deleteevouchers' ,'uses' => 'EvoucherController@delete'));
});
