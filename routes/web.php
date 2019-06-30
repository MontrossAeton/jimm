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

Route::get('/', 'HomeController@index');

Auth::routes(['verify' => true]);

Route::post('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
Route::resource('posts', 'PostsController');
Route::resource('gyms', 'GymsController');
Route::group(["prefix" => 'posts/{post}'], function() {
    Route::resource('comments', 'CommentsController')->only([
        'store', 'destroy'
    ]);
});
Route::resource('gym-images', 'GymImagesController');
Route::get('/maps', 'MapsController@index');
Route::post('/maps/search', 'MapsController@search');
Route::get('/maps/getLocations', 'MapsController@getLocations');
Route::get('/assessment', 'HomeController@assessment');

Route::group(["prefix" => 'user'], function() {
    Route::put("/update", "UserController@update")->name('user.update');
    Route::post("/change-profile-picture", "UserController@changeProfilePicture")->name('user.change-profile-picture');

    Route::put("/change-password", "UserController@changePassword")->name('user.change-password');

    Route::delete("/remove-profile-picture", "UserController@removeProfilePicture")->name('user.remove-profile-picture');
});

Route::post('register-admin', 'Auth\RegisterController@registerAdmin')->name('register.admin');

Route::group(['middleware' => ['auth', 'user', 'verified']], function() {
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/home', 'HomeController@index');
    Route::post('/subscription', 'SubscriptionController@store')->name('subscriptions.store');
    Route::resource('ads', 'AdsController')->only(['store']);
    Route::delete('posts/{post}/delete-photo', 'PostsController@deletePhoto');
    Route::get('my_posts', 'PostsController@my_posts');
    Route::group(['prefix' => 'gyms/{gym}'], function() {
        Route::resource('reservations', 'ReservationsController');
        Route::resource('reviews', 'ReviewsController')->only([
            'store', 'update', 'destroy'
        ]);
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {
  Route::get('/', 'HomeController@index');
  Route::get('/profile', 'ProfileController@index');

  Route::group(['middleware' => ['check_gym_admin']], function() {
      Route::delete('posts/{post}/delete-photo', 'PostsController@deletePhoto');
      Route::resource('posts', 'PostsController');
      Route::post('users/{user}/restore', 'UsersController@restore')->name('users.restore');
      Route::resource('users', 'UsersController');
      Route::resource('services', 'ServicesController');
      Route::resource('gym-images', 'GymImagesController');
      Route::delete('/gyms/{gym}/delete-gym-logo', 'GymsController@deleteGymLogo')->name('gyms.delete-gym-logo');
      Route::post('/gyms/{gym}/restore', 'GymsController@restore')->name('gyms.restore');
      Route::resource('gyms', 'GymsController');
      Route::delete('ads/{ad}/delete-photo', 'AdsController@deletePhoto');
      Route::post('ads/{ad}/update', 'AdsController@update')->name('ads.update');
      Route::resource('ads', 'AdsController')->except('update');
      Route::group(['prefix' => 'ads/{ad}'], function() {
          Route::put('approve', 'AdsController@approve')->name('ads.approve');
          Route::put('reject', 'AdsController@reject')->name('ads.reject');
      });

      Route::post('premium-ads-subscription', 'SubscriptionsController@premiumAdsSubscription')->name('subscriptions.premium-ads-subscription');
      Route::resource('subscriptions', 'SubscriptionsController');
      Route::resource('feedbacks', 'FeedbacksController')->only([
          'index', 'destroy'
      ]);
      Route::group(['prefix' => 'subscriptions/{subscription}'], function() {
          Route::put('approve', 'SubscriptionsController@approve')->name('subscriptions.approve');
          Route::put('reject', 'SubscriptionsController@reject')->name('subscriptions.reject');
      });
      Route::resource('reservations', 'ReservationsController');
      Route::group(['prefix' => 'reservations/{reservation}'], function() {
          Route::put('approve', 'ReservationsController@approve')->name('reservations.approve');
          Route::put('reject', 'ReservationsController@reject')->name('reservations.reject');
      });

      Route::group(['prefix' => 'reports', 'as' => 'reports.'], function() {
          Route::get('/', 'ReportsController@index')->name('index');
          Route::get('/user-logs', 'ReportsController@userLogs')->name('user-logs');
          Route::get('/system-users', 'ReportsController@systemUsers')->name('system-users');
          Route::get('/customers', 'ReportsController@customers')->name('customers');
          Route::get('/gym-companies', 'ReportsController@gymCompanies')->name('gym-companies');
          Route::get('/subscriptions', 'ReportsController@subscriptions')->name('subscriptions');
          Route::get('/services', 'ReportsController@services')->name('services');
          Route::get('/reservations', 'ReportsController@reservations')->name('reservations');
          Route::get('/ratings-and-reviews', 'ReportsController@ratingsAndReviews')->name('ratings-and-reviews');
      });

      Route::get('/locations', 'LocationsController@index')->name('locations.index');
  });
});
