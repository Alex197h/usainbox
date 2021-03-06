<?php

Route::get('/', 'HomeController@index')->name('home');

Route::post('gettransportmap', 'HomeController@ptest')->name('gettransportmap');

Route::get('map', function() {return view('map');});

Route::post('transport-search', 'TransportOffersController@search')->name('transport');

Route::get('offer/transport/create', 'TransportOffersController@create')->name('create_transport_offer');
Route::post('offer/transport/create', 'TransportOffersController@postCreate')->name('post_create_transport_offer');


Route::bind('transport_id', function($id) {
    return App\TransportOffer::with('questions.user')->findOrFail($id);
});
Route::any('offer/transport/detail/{transport_id?}', 'TransportOffersController@detail')->name('detail_transport_offer');
Route::post('offer/transport/booking', 'TransportOffersController@booking')->name('booking');
Route::post('offer/transport/booking/save', 'TransportOffersController@booking_validate')->name('booking_validate');


Route::any('alert/create', 'ShippingOffersController@index')->name('create_alert');
Route::post('alert/save', 'ShippingOffersController@save')->name('save_alert');
Route::get('autosearch', 'ShippingOffersController@autoSearch')->name('autoSearch');

Route::get('offer/shipping/create', 'ShippingOffersController@create')->name('create_shipping_offer');
Route::post('offer/shipping/create', 'ShippingOffersController@postCreate')->name('post_create_shipping_offer');

Route::any('vehicles/brands', 'HomeController@getVehiclesBrands')->name('get_vehicles_brands');



Route::get('page/{page}', 'AboutController@page')->name('page');
Route::get('contact', 'AboutController@contact')->name('contact');
Route::post('contact', 'AboutController@postcontact')->name('contact_post');



Route::model('vehicle_id', App\Vehicle::class);
Route::model('ad_id', App\TransportOffer::class);
Route::get('user/profile', 'UserController@getProfileAuth')->name('user_profile');
Route::post('user/profile', 'UserController@updateProfileAuth')->name('update_user_profile');
Route::get('user/profile/delete', 'UserController@deleteAuthProfile')->name('delete_auth_profile');
Route::get('user/notifications', 'UserController@getNotifications')->name('auth_notifications');

Route::any('user/vehicles/modify/{vehicle_id}', 'UserController@modifyVehicles')->name('modify_vehicle');
Route::get('user/vehicles/delete/{vehicle_id?}', 'UserController@deleteVehicle')->name('delete_vehicle');
Route::post('user/vehicles', 'UserController@postVehicles')->name('post_user_vehicles');
Route::get('user/vehicles', 'UserController@getVehicles')->name('user_vehicles');

Route::any('user/bookings', 'UserController@getBookingAuth')->name('my_bookings');
Route::any('user/bookings/validate', 'UserController@postBookingAuth')->name('post_booking');
Route::post('user/bookings/validate/post', 'UserController@validateBookingAuth')->name('validate_booking_auth');


Route::get('user/ads', 'UserController@getAdAuth')->name('my_ads');
Route::any('user/ads/modify/{ad_id}', 'UserController@modifyAds')->name('modify_ad');
Route::get('user/ads/delete/{ad_id?}', 'UserController@deleteAd')->name('delete_ad');



Route::model('user_id', App\User::class);
Route::get('user/{user_id}', 'UserController@getProfile')->name('profile');



Route::get('admin', 'AdminController@home')->name('admin');
Route::any('admin/{page}/{type?}/{id?}', 'AdminController@page')->name('admin_page');




// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
