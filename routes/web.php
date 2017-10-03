<?php


/**
 * Default
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Kaizen Project
 */
Route::prefix('kaizen')->group(function(){
    Route::get('slots', 'Kaizen\KaizenController@index');
});

/**
 * Passport
 */
Route::get('/passport', function(){
    return view('passport.index');
})->name('passport');

/**
 * User Managements
 */
Route::get('/usersmanagement', 'UserController@index')->name('usersmanagement')->middleware('role:admin');

Route::get('roles', 'UserController@roles');

Route::post('assignRole', 'UserController@assignRole')->name('assignRole');

Route::post('revokeRole', 'UserController@revokeRole')->name('revokeRole');

/**
 * Testing Routes
 */
Route::prefix('testing')->group(function (){
    Route::get('/', 'TestController@index')->name('test');
});

/**
 * Profile Page
 */
Route::get('profile', 'ProfileController@index')->name('profile')->middleware('auth');

Route::post('postImage', 'ImageController@postImage')->name('postImage');

Route::prefix('upload')->group(function(){
    Route::post('update-profile-pic', 'ImageController@updateProfilePic')->name('update-profile-pic');
});