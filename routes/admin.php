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

	Route::any('/bills', 'BillController@index')->name("bills");
	Route::any('/bills', 'BillController@filteredlist')->name("bills.filteredlist");
	Route::get('/bills/create', 'BillController@create')->name('bills.create');
	Route::get('/bills/edit/{id}', 'BillController@edit')->name('bills.edit');
	Route::post('/bills/update/{id}', 'BillController@update')->name('bills.update');
	Route::post('/bills/delete/{id}', 'BillController@delete')->name('bills.delete');
	Route::post('/bills/store', 'BillController@store')->name('bills.store');
	Route::get('/bills/show/{id}', 'BillController@show')->name('bills.show');
	Route::get('/bills/download/{id}', 'BillController@download')->name('bills.download');
	Route::post('/get-flats', 'LocationController@getFlats');

	Route::any('/tenants', 'TenantController@index')->name("tenants");
	Route::get('/tenants/create', 'TenantController@create')->name('tenants.create');
	Route::get('/tenants/view/{id}', 'TenantController@show')->name('tenants.view');
	Route::get('/tenants/edit/{id}', 'TenantController@edit')->name('tenants.edit');
	Route::post('/tenants/update/{id}', 'TenantController@update')->name('tenants.update');
	Route::post('/tenants/delete/{id}', 'TenantController@delete')->name('tenants.delete');
	Route::post('/tenants/store', 'TenantController@store')->name('tenants.store');
	Route::get('/tenants/vata-handover/{id}', 'TenantController@vataHandover')->name('tenants.vata-handover');
	Route::post('/tenants/store-handover', 'TenantController@storeHandover')->name('tenants.store-handover');


	Route::any('/flatowners', 'FlatOwnerController@index')->name("flatowners");
	Route::get('/flatowners/create', 'FlatOwnerController@create')->name('flatowners.create');
	Route::get('/flatowners/view/{id}', 'FlatOwnerController@show')->name('flatowners.view');
	Route::get('/flatowners/edit/{id}', 'FlatOwnerController@edit')->name('flatowners.edit');
	Route::post('/flatowners/update/{id}', 'FlatOwnerController@update')->name('flatowners.update');
	Route::post('/flatowners/delete/{id}', 'FlatOwnerController@delete')->name('flatowners.delete');
	Route::post('/flatowners/store', 'FlatOwnerController@store')->name('flatowners.store');


	Route::get('/vata-handovers', 'VatahandoverController@index')->name("vata-handovers");
	
	Route::post('/get-district', 'LocationController@getDistrict');
	Route::post('/get-thana', 'LocationController@getThana');
	Route::post('/get-union', 'LocationController@getUnion');
	Route::post('/get-village', 'LocationController@getVillage');

 	//NOtifications
	Route::get('/notification', 'NotificationController@index')->name("notification");
	Route::delete('/notification_destroy/{id}', 'NotificationController@notification_destroy')->name("notification_destroy");

	
	//Reporting area
	Route::any('/rptflatowner', 'ReportController@getFlatOwnerReport')->name("rptflatowner");
	Route::get('/rptflatowner/individual', 'ReportController@getVataHandoverReport')->name("rptflatowner.individual");
	Route::any('/rptflat', 'ReportController@getFlatReport')->name("rptflat");
	Route::any('/rpttenant', 'ReportController@getTenantReport')->name("rpttenant");
	Route::any('/rptbill', 'ReportController@getBillReport')->name("rptbill");
	Route::any('/rptinout', 'ReportController@getInOutReport')->name("rptinout");
	Route::any('/reports/flatowners/list', 'ReportController@getFlatOwnerReport')->name("reports.flatowners.list");
	Route::any('/reports/flatowners/rptindividual/{id}', 'ReportController@getIndividualOwnerReport')->name("reports.flatowners.rptindividual");
	Route::any('/reports/flats/list', 'ReportController@getFlatReport')->name("reports.flats.list");
	Route::any('/reports/tenants/list', 'ReportController@getTenantReport')->name("reports.tenants.list");
	
	
	Route::get('/change-password', 'AdminController@changePassword')->name("change-password");
	Route::post('/update-password', 'AdminController@updatePassword')->name("update-password");
	
	//Route::post('/logout', 'AdminController@logout')->name("logout");
});

Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    App::setlocale($locale);
    return redirect()->back();
});
