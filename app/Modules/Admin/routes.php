<?php


Route::group(['module' => 'Admin', 'prefix' => 'Admin','middleware' => ['web'],'namespace' => 'App\Modules\Admin\Controllers'], function() {

    Route::get('/', array('as' => 'admin.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::get('/signin', array('as' => 'admin.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::post('/signin', array('as' => 'admin.signin' ,'uses' => 'LoginController@signin'));
    Route::get('/forgot_password', array('as' => 'admin.forgot_password' ,'uses' => 'LoginController@showForgotPasswordForm'));
    Route::post('/forgot_password', array('as' => 'admin.forgot_password' ,'uses' => 'LoginController@forgot_password'));
    Route::get('/reset_password/{token?}', array('as' => 'admin.reset_password' ,'uses' => 'LoginController@showResetPasswordForm'));
    Route::post('/reset_password', array('as' => 'admin.reset_password' ,'uses' => 'LoginController@reset_password'));
    Route::get('/signout', array('as' => 'admin.signout' ,'uses' => 'LoginController@signout'));

});


// Admin password protected routes
Route::group(['module' => 'Admin', 'prefix' => 'Admin','middleware' => ['web','admin'],'namespace' => 'App\Modules\Admin\Controllers'], function() {

    // Dashboard Routes
    Route::get('/dashboard', array('as' => 'admin.dashboard' ,'uses' => 'DashboardController@index'));
    Route::get('/autologin/{uuid?}', array('as' => 'admin.entityAutoLogin' ,'uses' => 'EntityController@AutoLoginEntity'));
    //Entity Routes

    Route::get('/entities', array('as' => 'admin.entities' ,'uses' => 'EntityController@index'));
    Route::get('/AddNewEntity', array('as' => 'admin.AddEntity' ,'uses' => 'EntityController@ViewAddForm'));
    Route::post('/SaveEntity', array('as' => 'admin.saveEntity' ,'uses' => 'EntityController@saveEntitydata'));
    Route::get('/editEntity/{uuid?}', array('as' => 'admin.editEntity' ,'uses' => 'EntityController@ViewEditForm'));
    Route::get('/deleteEntity/{uuid?}', array('as' => 'admin.deleteEntity' ,'uses' => 'EntityController@DeleteEntity'));


     //Entity Branches
      Route::get('/viewEnityBranches/{uuid?}', array('as' => 'admin.entityBranch' ,'uses' => 'EntityBranchController@ViewEntityBranches'));
      Route::get('/AddNewEntityBranch/{uuid?}', array('as' => 'admin.AddEntityBranch' ,'uses' => 'EntityBranchController@ViewAddForm'));
      Route::post('/SaveEntityBranch', array('as' => 'admin.saveEntityBranch' ,'uses' => 'EntityBranchController@saveEntityBranchdata'));
    Route::get('/editEntityBranch/{uuid?}', array('as' => 'admin.editEntityBranch' ,'uses' => 'EntityBranchController@ViewEditForm'));

    Route::get('/deleteEntityBranch/{uuid?}', array('as' => 'admin.deleteEntityBranch' ,'uses' => 'EntityBranchController@DeleteEntity'));

    Route::post('/getCities', array('as' => 'admin.getCities' ,'uses' => 'EntityBranchController@getCities'));
    //Categories Routes
    //Route::get('/category', array('as' => 'admin.categories' ,'uses' => 'CategoryController@create'));

    //Categories Routes

    Route::get('/category', array('as' => 'admin.categories' ,'uses' => 'CategoryController@index'));
    Route::get('/category_create', array('as' => 'admin.categories_create' ,'uses' => 'CategoryController@create'));

    Route::POST('/category_add', array('as' => 'admin.category_add' ,'uses' => 'CategoryController@store'));

    Route::get('/category_list', array('as' => 'admin.category_list' ,'uses' => 'CategoryController@show'));
    Route::get('/category_edit/{id}', array('as' => 'admin.category_edit' ,'uses' => 'CategoryController@Category_edit'));
    Route::get('/category_delete/{id}', array('as' => 'admin.category_delete' ,'uses' => 'CategoryController@Category_delete'));


    //Cuisines Routes
    Route::get('/cuisines', array('as' => 'admin.cuisines' ,'uses' => 'CuisinesController@index'));
    Route::get('/cuisines_create', array('as' => 'admin.cuisines_create' ,'uses' => 'CuisinesController@create'));
    Route::POST('/cuisines_add', array('as' => 'admin.cuisines_add' ,'uses' => 'CuisinesController@store'));
    Route::get('/cuisines_edit/{id}', array('as' => 'admin.cuisines_edit' ,'uses' => 'CuisinesController@Cuisines_edit'));
    Route::get('/cuisines_delete/{id}', array('as' => 'admin.cuisines_delete' ,'uses' => 'CuisinesController@Cuisines_delete'));



    //sponsored Routes
    Route::get('/sponsored', array('as' => 'admin.sponsored' ,'uses' => 'SponsoredController@index'));
    Route::get('/sponsored_create', array('as' => 'admin.sponsored_create' ,'uses' => 'SponsoredController@create'));
    Route::POST('/sponsored_add', array('as' => 'admin.sponsored_add' ,'uses' => 'SponsoredController@store'));
    Route::get('/sponsored_edit/{id}', array('as' => 'admin.sponsored_edit' ,'uses' => 'SponsoredController@sponsored_edit'));
    Route::get('/sponsored_delete/{id}', array('as' => 'admin.sponsored_delete' ,'uses' => 'SponsoredController@sponsored_delete'));

    //Entity Settings Routes
    Route::get('/entity_settings', array('as' => 'admin.entity_settings' ,'uses' => 'EntitiesSettingsController@index'));
    Route::get('/entity_settings_create/{uuid?}', array('as' => 'admin.entity_settings_create' ,'uses' => 'EntitiesSettingsController@create'));
    Route::POST('/entity_settings_add', array('as' => 'admin.entity_settings_create_add' ,'uses' => 'EntitiesSettingsController@store'));
    Route::get('/entity_settings_edit/{id}', array('as' => 'admin.entity_settings_edit' ,'uses' => 'EntitiesSettingsController@entity_settings_edit'));
    Route::get('/entity_settings_delete/{id}', array('as' => 'admin.entity_settings_delete' ,'uses' => 'EntitiesSettingsController@entity_settings_delete'));


    //Admin Settings Routes

    Route::get('/settings_create', array('as' => 'admin.settings' ,'uses' => 'SettingsController@create'));
    Route::POST('/settings_add', array('as' => 'admin.settings_create_add' ,'uses' => 'SettingsController@store'));

    //Area Management Route
    Route::get('/area_management', array('as' => 'admin.area_management' ,'uses' => 'AreaManagementController@index'));
    Route::get('/area_management_create', array('as' => 'admin.area_management_create' ,'uses' => 'AreaManagementController@create'));
    Route::POST('/area_management_add', array('as' => 'admin.area_management_add' ,'uses' => 'AreaManagementController@store'));
    Route::get('/area_management_edit/{id}', array('as' => 'admin.area_management_edit' ,'uses' => 'AreaManagementController@area_management_edit'));
    Route::get('/area_management_delete/{id}', array('as' => 'admin.area_management_delete' ,'uses' => 'AreaManagementController@area_management_delete'));

    //Sub Area Management Route
    Route::get('/sub_area_management/{uuid}', array('as' => 'admin.sub_area_management' ,'uses' => 'SubAreaManagementController@index'));
    Route::get('/sub_area_management_create/{uuid}', array('as' => 'admin.sub_area_management_create' ,'uses' => 'SubAreaManagementController@create'));
   Route::POST('/sub_area_management_add', array('as' => 'admin.sub_area_management_add' ,'uses' => 'SubAreaManagementController@store'));
   Route::get('/sub_area_management_edit/{id}/{uuid}', array('as' => 'admin.sub_area_management_edit' ,'uses' => 'SubAreaManagementController@sub_area_management_edit'));
   Route::get('/sub_area_management_delete/{id}', array('as' => 'admin.sub_area_management_delete' ,'uses' => 'SubAreaManagementController@sub_area_management_delete'));
    //Affiliates Routes
    Route::get('/affiliates', array('as' => 'admin.affiliates' ,'uses' => 'AffiliatesController@index'));
    Route::get('/createaffiliates', array('as' => 'admin.createaffiliates' ,'uses' => 'AffiliatesController@create'));
    Route::POST('/storeaffiliates', array('as' => 'admin.storeaffiliates' ,'uses' => 'AffiliatesController@store'));
    Route::get('/editaffiliates/{uuid}', array('as' => 'admin.editaffiliates' ,'uses' => 'AffiliatesController@edit'));
    Route::patch('/updateaffiliates/{uuid}', array('as' => 'admin.updateaffiliates' ,'uses' => 'AffiliatesController@update'));
    Route::get('/deleteaffiliates/{id}', array('as' => 'admin.deleteaffiliates' ,'uses' => 'AffiliatesController@delete'));
    Route::POST('/sub_area_list', array('as' => 'admin.sub_area_list' ,'uses' => 'AffiliatesController@getSubAreas'));

    //Order Status Routes
    Route::get('/orderstatus', array('as' => 'admin.orderstatus' ,'uses' => 'OrderStatusController@index'));
    Route::get('/orderstatus_create', array('as' => 'admin.orderstatus_create' ,'uses' => 'OrderStatusController@create'));
    Route::POST('/orderstatus_add', array('as' => 'admin.orderstatus_add' ,'uses' => 'OrderStatusController@store'));
    Route::get('/orderstatus_edit/{id}', array('as' => 'admin.orderstatus_edit' ,'uses' => 'OrderStatusController@edit'));
    Route::get('/orderstatus_delete/{id}', array('as' => 'admin.orderstatus_delete' ,'uses' => 'OrderStatusController@delete'));

    //OrderManagement Routes
    Route::get('/orders', array('as' => 'admin.orders' ,'uses' => 'OrdersController@index'));
    
    //Ajax Orders Routes
    Route::get('/order_details/action', 'OrdersController@orderDetailsAction')->name('order_details.action');
    Route::get('/status_details/action', 'OrdersController@statusDetailsAction')->name('status_details.action');
    Route::get('/store_status/action', 'OrdersController@statusStoreAction')->name('store_status.action');

    //Customer Management Routes
    Route::get('/customers', array('as' => 'admin.customers' ,'uses' => 'CustomerController@index'));

    //AJAX Customer Management Routes
    Route::get('/customer_order_details/action', 'CustomerController@CustomerOrdersAction')->name('customer_order_details.action');

    //OrderPlaced Notification Event Route
    Route::get('/testnotification', function () {
    event(new App\Events\OrderPlaced('New Order Received', '1'));
        return "Event has been sent!";
    });
});
