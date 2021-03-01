<?php

Auth::routes();

Route::namespace('Admin')->group(function () {
	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth\LoginController@login');

	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
	Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::namespace('Admin')->middleware(['auth.admin', 'setlocale'])->group(function () {

	Route::get('/', 'DashboardController@index')->name("dashboard");

	Route::resource('/admin', 'AdminController');

	Route::get('/billheads', 'BillHeadController@index')->name("billheads");
	Route::get('/billheads/create', 'BillHeadController@create')->name('billheads.create');
	Route::get('/billheads/edit/{id}', 'BillHeadController@edit')->name('billheads.edit');
	Route::post('/billheads/update/{id}', 'BillHeadController@update')->name('billheads.update');
	Route::post('/billheads/delete/{id}', 'BillHeadController@delete')->name('billheads.delete');
	Route::post('/billheads/store', 'BillHeadController@store')->name('billheads.store');

	Route::get('/floors', 'FloorController@index')->name("floors");
	Route::get('/floors/create', 'FloorController@create')->name('floors.create');
	Route::get('/floors/edit/{id}', 'FloorController@edit')->name('floors.edit');
	Route::post('/floors/update/{id}', 'FloorController@update')->name('floors.update');
	Route::post('/floors/delete/{id}', 'FloorController@delete')->name('floors.delete');
	Route::post('/floors/store', 'FloorController@store')->name('floors.store');

	Route::any('/flats', 'FlatController@index')->name("flats");
	Route::get('/flats/create', 'FlatController@create')->name('flats.create');
	Route::get('/flats/edit/{id}', 'FlatController@edit')->name('flats.edit');
	Route::post('/flats/update/{id}', 'FlatController@update')->name('flats.update');
	Route::post('/flats/delete/{id}', 'FlatController@delete')->name('flats.delete');
	Route::post('/flats/store', 'FlatController@store')->name('flats.store');

	Route::any('/thanas', 'ThanaController@index')->name("thanas");
	Route::get('/thanas/create', 'ThanaController@create')->name('thanas.create');
	Route::get('/thanas/edit/{id}', 'ThanaController@edit')->name('thanas.edit');
	Route::post('/thanas/update/{id}', 'ThanaController@update')->name('thanas.update');
	Route::post('/thanas/delete/{id}', 'ThanaController@delete')->name('thanas.delete');
	Route::post('/thanas/store', 'ThanaController@store')->name('thanas.store');

	Route::any('/unions', 'UnionController@index')->name("unions");
	Route::get('/unions/create', 'UnionController@create')->name('unions.create');
	Route::get('/unions/edit/{id}', 'UnionController@edit')->name('unions.edit');
	Route::post('/unions/update/{id}', 'UnionController@update')->name('unions.update');
	Route::post('/unions/delete/{id}', 'UnionController@delete')->name('unions.delete');
	Route::post('/unions/store', 'UnionController@store')->name('unions.store');

	Route::any('/villages', 'VillageController@index')->name("villages");
	Route::get('/villages/create', 'VillageController@create')->name('villages.create');
	Route::get('/villages/edit/{id}', 'VillageController@edit')->name('villages.edit');
	Route::post('/villages/update/{id}', 'VillageController@update')->name('villages.update');
	Route::post('/villages/delete/{id}', 'VillageController@delete')->name('villages.delete');
	Route::post('/villages/store', 'VillageController@store')->name('villages.store');

	Route::get('/vatatypes', 'VatatypeController@index')->name("vatatypes");
	Route::get('/vatatypes/create', 'VatatypeController@create')->name('vatatypes.create');
	Route::get('/vatatypes/edit/{id}', 'VatatypeController@edit')->name('vatatypes.edit');
	Route::post('/vatatypes/update/{id}', 'VatatypeController@update')->name('vatatypes.update');
	Route::post('/vatatypes/delete/{id}', 'VatatypeController@delete')->name('vatatypes.delete');
	Route::post('/vatatypes/store', 'VatatypeController@store')->name('vatatypes.store');

	Route::any('/tenants', 'TenantController@index')->name("tenants");
	Route::get('/tenants/create', 'TenantController@create')->name('tenants.create');
	Route::get('/tenants/view/{id}', 'TenantController@show')->name('tenants.view');
	Route::get('/tenants/edit/{id}', 'TenantController@edit')->name('tenants.edit');
	Route::post('/tenants/update/{id}', 'TenantController@update')->name('tenants.update');
	Route::post('/tenants/delete/{id}', 'TenantController@delete')->name('tenants.delete');
	Route::post('/tenants/store', 'TenantController@store')->name('tenants.store');
	Route::get('/tenants/vata-handover/{id}', 'TenantController@vataHandover')->name('tenants.vata-handover');
	Route::post('/tenants/store-handover', 'TenantController@storeHandover')->name('tenants.store-handover');

	Route::get('/vata-handovers', 'VatahandoverController@index')->name("vata-handovers");
	
	Route::post('/get-district', 'LocationController@getDistrict');
	Route::post('/get-thana', 'LocationController@getThana');
	Route::post('/get-union', 'LocationController@getUnion');
	Route::post('/get-village', 'LocationController@getVillage');

 	//NOtifications
	Route::get('/notification', 'NotificationController@index')->name("notification");
	Route::delete('/notification_destroy/{id}', 'NotificationController@notification_destroy')->name("notification_destroy");

	Route::any('/citizen-report', 'ReportController@getCitizenReport')->name("citizen-report");
	Route::any('/vata-handover-report', 'ReportController@getVataHandoverReport')->name("vata-handover-report");
	
	Route::get('/change-password', 'AdminController@changePassword')->name("change-password");
	Route::post('/update-password', 'AdminController@updatePassword')->name("update-password");
	
	//Route::post('/logout', 'AdminController@logout')->name("logout");
});

Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    App::setlocale($locale);
    return redirect()->back();
});
