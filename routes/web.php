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

    Route::post('delete', 'ImageController@deleteProfilePic')->name('delete-profile-pic');
});

/**
 * Images
 */
Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/app/public/images/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::get('changepassword', 'AccountSettings\PasswordController@index')->name('changepassword');

Route::post('updatepassword', 'AccountSettings\PasswordController@update')->name('updatepassword');