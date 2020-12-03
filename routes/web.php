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

//Route::get('/', function () {
//    return view('welcome');
//
//});

Route::get('/', 'WelcomeController@showLoginForm');


//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('signin');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index');

//POST MESSAGE RECIVED
//Route::get('devices/{pack_id}',)


//POLLING DATA
//Route::post('polling/{device_name}/{site_id}/{sn_pack}/{pack_id}', 'PollingController@polling')->name('polling');
Route::post('polling/{device_name}/{site_id}/{sn_original}/{battery_id}/{sn_battery}/{pack_id}', 'PollingController@pollingNew')->name('polling');

//Route::post('alarm/{device_name}/{site_id}/{sn_pack}/{pack_id}', 'PollingController@alarm')->name('alarm');
Route::post('alarm/{device_name}/{site_id}/{sn_original}/{battery_id}/{sn_battery}/{pack_id}', 'PollingController@alarm')->name('alarm');


//DASHBOARD
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('coordinate-map', 'DashboardController@siteMap')->name('coordinate-map');
Route::get('marker-information', 'DashboardController@markerInformation')->name('marker-information');
Route::get('debug-map', 'DashboardController@map');


//MONITORING
//TODO: no error notif, if no node registered
Route::get('monitoring', 'MonitoringController@index')->name('monitoring');
Route::get('monitoring-show', 'MonitoringController@show')->name('monitoring-show');
Route::get('node-tree', 'MonitoringController@nodeTree')->name('node-tree');
Route::get('alarm-notification', 'MonitoringController@show')->name('alarm-notification');

//INBOX DATA RECEIVED (for debug only, on release will be hidden)
Route::get('log-inbox','InboxPostController@index')->name('log-inbox');
Route::get('log-inbox-show','InboxPostController@show')->name('log-inbox-show');


//DATALOG
Route::get('log-data', 'DatalogController@index')->name('log-data');
Route::get('log-data-show', 'DatalogController@show')->name('log-data-show');
Route::get('log-data-pack', 'DatalogController@pack')->name('log-data-pack');
Route::get('log-data-pack-periode', 'DatalogController@periode')->name('log-data-pack-periode');
Route::get('log-data-download', 'DatalogController@download')->name('log-data-download');
Route::get('log-data-chart','DatalogController@chart')->name('log-data-chart');
Route::get('log-data-chart-periode','DatalogController@chartPeriode')->name('log-data-chart-periode');


//EVENTLOG
Route::get('log-event', 'EventlogController@index')->name('log-event');
Route::get('log-event-show', 'EventlogController@show')->name('log-event-show');
Route::get('log-event-pack', 'EventlogController@pack')->name('log-event-pack');
Route::get('log-event-pack-periode', 'EventlogController@periode')->name('log-event-pack-periode');
Route::get('log-event-download', 'EventlogController@download')->name('log-event-download');


//REPORT
//RAW REPORT
Route::get('raw-report','RawReportController@index')->name('raw-report');
Route::get('raw-report-show','RawReportController@show')->name('raw-report-show');
Route::get('raw-report-pack','RawReportController@pack')->name('raw-report-pack');
Route::get('raw-report-periode','RawReportController@periode')->name('raw-report-periode');
Route::get('raw-report-download','RawReportController@download')->name('raw-report-download');



//SUMMARY MONTHLY REPORT
Route::get('summary-report','SummaryReportController@index')->name('summary-report');
Route::get('summary-report-show','SummaryReportController@show')->name('summary-report-show');



//MANUFACTURER
Route::get('manufaturer', 'ManufacturerController@index')->name('manufacturer');
Route::get('manufacture-list', 'ManufacturerController@show')->name('manufacture-list');
Route::get('manufacture-edit/{id}', 'ManufacturerController@edit')->name('manufacture-edit');
Route::post('manufacture-create', 'ManufacturerController@store')->name('manufacture-create');
Route::post('manufacture-update/{id}', 'ManufacturerController@update')->name('manufacture-update');
Route::delete('manufacture-destroy/{id}', 'ManufacturerController@destroy')->name('manufacture-destroy');


//DEVICE TYPE
Route::get('device-type', 'DeviceTypeController@index')->name('device-type');
Route::get('device-type-list', 'DeviceTypeController@show')->name('device-type-list');
Route::get('device-type-edit/{id}', 'DeviceTypeController@edit')->name('device-type-edit');
Route::post('device-type-create', 'DeviceTypeController@store')->name('device-type-create');
Route::post('device-type-update/{id}', 'DeviceTypeController@update')->name('device-type-update');
Route::delete('device-type-destroy/{id}', 'DeviceTypeController@destroy')->name('device-type-destroy');


//DEVICE
//todo: change from snmp to http in device_form
Route::get('device', 'DeviceController@index')->name('device');
Route::get('device-list', 'DeviceController@show')->name('device-list');
Route::get('device-edit/{id}', 'DeviceController@edit')->name('device-edit');
Route::post('device-create', 'DeviceController@store')->name('device-create');
Route::post('device-update/{id}', 'DeviceController@update')->name('device-update');
Route::delete('device-destroy/{id}', 'DeviceController@destroy')->name('device-destroy');


//PARAMETER POLLING
Route::get('parameter-polling', 'ParameterPollingController@index')->name('parameter-polling');
Route::get('polling-object-list', 'ParameterPollingController@show')->name('polling-object-list');
Route::get('polling-object-edit/{id}', 'ParameterPollingController@edit')->name('polling-object-edit');
Route::post('polling-object-create', 'ParameterPollingController@store')->name('polling-object-create');
Route::post('polling-object-update/{id}', 'ParameterPollingController@update')->name('polling-object-update');
Route::delete('polling-object-destroy/{id}', 'ParameterPollingController@destroy')->name('polling-object-destroy');


//PARAMETER ALARM
Route::get('parameter-alarm', 'ParameterAlarmController@index')->name('parameter-alarm');
Route::get('trap-object-list', 'ParameterAlarmController@show')->name('trap-object-list');
Route::get('trap-object-edit/{id}', 'ParameterAlarmController@edit')->name('trap-object-edit');
Route::post('trap-object-create', 'ParameterAlarmController@store')->name('trap-object-create');
Route::post('trap-object-update/{id}', 'ParameterAlarmController@update')->name('trap-object-update');
Route::delete('trap-object-destroy/{id}', 'ParameterAlarmController@destroy')->name('trap-object-destroy');

//REGION
Route::get('region', 'RegionController@index')->name('region');
Route::get('region-list', 'RegionController@show')->name('region-list');
Route::get('region-edit/{id}', 'RegionController@edit')->name('region-edit');
Route::post('region-create', 'RegionController@store')->name('region-create');
Route::post('region-update/{id}', 'RegionController@update')->name('region-update');
Route::delete('region-destroy/{id}', 'RegionController@destroy')->name('region-destroy');


//CITY
Route::get('city', 'CityController@index')->name('city');
Route::get('city-list', 'CityController@show')->name('city-list');
Route::get('city-edit/{id}', 'CityController@edit')->name('city-edit');
Route::post('city-create', 'CityController@store')->name('city-create');
Route::post('city-update/{id}', 'CityController@update')->name('city-update');
Route::delete('city-destroy/{id}', 'CityController@destroy')->name('city-destroy');


//SITE
Route::get('site', 'SiteController@index')->name('site');
Route::get('site-list', 'SiteController@show')->name('site-list');
Route::get('site-edit/{id}', 'SiteController@edit')->name('site-edit');
Route::post('site-create', 'SiteController@store')->name('site-create');
Route::post('site-update/{id}', 'SiteController@update')->name('site-update');
Route::delete('site-destroy/{id}', 'SiteController@destroy')->name('site-destroy');


//NODE
Route::get('node', 'NodeController@index')->name('node');
Route::get('node-list', 'NodeController@show')->name('node-list');
Route::get('node-edit/{id}', 'NodeController@edit')->name('node-edit');
Route::post('node-create', 'NodeController@store')->name('node-create');
Route::post('node-update/{id}', 'NodeController@update')->name('node-update');
Route::delete('node-destroy/{id}', 'NodeController@destroy')->name('node-destroy');


//USER MANAGEMENT
Route::get('user-management', 'UserController@index')->name('user-management');
Route::get('user-show', 'UserController@show')->name('user-list');
Route::get('user-edit/{id}', 'UserController@edit')->name('user-edit');
Route::post('user-create', 'UserController@store')->name('user-create');
Route::post('user-update/{id}', 'UserController@update')->name('user-update');
Route::delete('user-destroy/{id}', 'UserController@destroy')->name('user-destroy');

//DEBUG
Route::get('debug-test', 'HomeController@debug3');
//Route::post('debug-polling/{device_name}/{site_id}/{battery_id}/{sn_battery}/{pack_id}', 'PollingController@debugForRawReport2');
//Route::post('debug-polling3/{device_name}/{site_id}/{battery_id}/{sn_battery}/{pack_id}', 'PollingController@debugForRawReport3');
//Route::get('debug-select-polling','PollingController@debugSelect');
//Route::post('debug-polling3/{device_name}/{site_id}/{battery_id}/{sn_battery}/{pack_id}', 'PollingController@debugForRawReport3');


