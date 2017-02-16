<?php

Route::get('/', function () {
    return view('front/pages/accueil');
})->name('home');

Route::get('/map', function() {
    return view('map');
});

Route::get('/home', 'HomeController@index');

Route::get('/transport-offers', 'TransportOffersController@index')->name('transport-offers');
Route::post('/transport-search', 'TransportOffersController@search')->name('transport');

Route::get('/shipping-offers', 'ShippingOffersController@index')->name('shippin-offers');



Route::get('contact', 'AboutController@create')->name('contact');
Route::post('contact', 'AboutController@store')->name('contact_post');

/* A supprimer */
Route::get('test', 'AboutController@test')->name('test');


Route::get('user/profile', 'UserController@getProfileAuth')->name('user_profile');




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
