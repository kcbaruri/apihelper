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

	Route::get('/divisions', 'DivisionController@index')->name("divisions");
	Route::get('/divisions/create', 'DivisionController@create')->name('divisions.create');
	Route::get('/divisions/edit/{id}', 'DivisionController@edit')->name('divisions.edit');
	Route::post('/divisions/update/{id}', 'DivisionController@update')->name('divisions.update');
	Route::post('/divisions/delete/{id}', 'DivisionController@delete')->name('divisions.delete');
	Route::post('/divisions/store', 'DivisionController@store')->name('divisions.store');

	Route::get('/departments', 'DepartmentController@index')->name("departments");
	Route::get('/departments/create', 'DepartmentController@create')->name('departments.create');
	Route::get('/departments/edit/{id}', 'DepartmentController@edit')->name('departments.edit');
	Route::post('/departments/update/{id}', 'DepartmentController@update')->name('departments.update');
	Route::post('/departments/delete/{id}', 'DepartmentController@delete')->name('departments.delete');
	Route::post('/departments/store', 'DepartmentController@store')->name('departments.store');

	Route::any('/districts', 'DistrictController@index')->name("districts");
	Route::get('/districts/create', 'DistrictController@create')->name('districts.create');
	Route::get('/districts/edit/{id}', 'DistrictController@edit')->name('districts.edit');
	Route::post('/districts/update/{id}', 'DistrictController@update')->name('districts.update');
	Route::post('/districts/delete/{id}', 'DistrictController@delete')->name('districts.delete');
	Route::post('/districts/store', 'DistrictController@store')->name('districts.store');

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

	Route::any('/citizens', 'CitizenController@index')->name("citizens");
	Route::get('/citizens/create', 'CitizenController@create')->name('citizens.create');
	Route::get('/citizens/view/{id}', 'CitizenController@show')->name('citizens.view');
	Route::get('/citizens/edit/{id}', 'CitizenController@edit')->name('citizens.edit');
	Route::post('/citizens/update/{id}', 'CitizenController@update')->name('citizens.update');
	Route::post('/citizens/delete/{id}', 'CitizenController@delete')->name('citizens.delete');
	Route::post('/citizens/store', 'CitizenController@store')->name('citizens.store');
	Route::get('/citizens/vata-handover/{id}', 'CitizenController@vataHandover')->name('citizens.vata-handover');
	Route::post('/citizens/store-handover', 'CitizenController@storeHandover')->name('citizens.store-handover');

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
