<?php

Route::get('/', 'HomeController@index')->name('home');


Route::get('/map', function() {
    return view('map');
});

Route::post('/transport-search', 'TransportOffersController@search')->name('transport');

Route::get('/offer/transport/create', 'TransportOffersController@create')->name('create_transport_offer');
Route::post('/offer/transport/create', 'TransportOffersController@postCreate')->name('post_create_transport_offer');


Route::get('/shipping-offers', 'ShippingOffersController@index')->name('shippin-offers');

Route::get('/offer/shipping/create', 'ShippingOffersController@create')->name('create_shipping_offer');
Route::post('/offer/shipping/create', 'ShippingOffersController@postCreate')->name('post_create_shipping_offer');



Route::get('page/{page}', 'AboutController@page')->name('page');
Route::get('contact', 'AboutController@contact')->name('contact');
Route::post('contact', 'AboutController@postcontact')->name('contact_post');

/* A supprimer */
Route::get('test', 'AboutController@test')->name('test');
Route::any('gettransportmap', 'HomeController@ptest')->name('gettransportmap');


Route::get('user/profile', 'UserController@getProfileAuth')->name('user_profile');
Route::get('user/vehicles', 'UserController@getVehicles')->name('user_vehicles');
Route::post('user/vehicles', 'UserController@postVehicles')->name('post_user_vehicles');




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
