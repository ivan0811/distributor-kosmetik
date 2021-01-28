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

Auth::routes();

//wilayah
Route::get('/get-provinsi', 'APIController@getProvinsi')->name('get_provinsi');
Route::post('/get-kabupaten', 'APIController@getKabupaten')->name('get_kabupaten');

Route::group(['middleware' => ['web', 'auth']], function () {
    //nav
    Route::get('/nav', function(){
        return view('navigation.navigation');
    });
    //dashboard
    Route::get('/', 'MainController@dashboard')->name('dashboard');    

    //edit-profile
    Route::get('/edit-profile', 'UserController@editProfile')->name('profile_user');
    Route::patch('/update-profile', 'UserController@updateProfile')->name('update_profile');    

    Route::prefix('/toko')->group(function(){
        Route::get('/', 'TokoController@toko')->name('toko');
        Route::get('/create-toko', 'TokoController@createToko')->name('create_toko');
        Route::post('/store-toko', 'TokoController@storeToko')->name('store_toko');
        Route::get('/edit-toko/{id}', 'TokoController@editToko')->name('edit_toko');
        Route::patch('update-toko', 'TokoController@updateToko')->name('update_toko');
        Route::delete('/delete-toko/{id}', 'TokoController@deleteToko')->name('delete_toko');
    });

    Route::group(['middleware' => 'Admin'], function () {
        //crud user        
        Route::prefix('/user')->group(function(){
            Route::get('/', 'UserController@user')->name('user');
            Route::get('/create-user', 'UserController@createUser')->name('create_user');
            Route::post('/store-user', 'UserController@storeUser')->name('store_user');
            Route::get('/show-user/{id}', 'UserController@showUser')->name('show_user');
            Route::get('/edit-user/{id}', 'UserController@editUser')->name('edit_user');
            Route::patch('/update-user', 'UserController@updateUser')->name('update_user');
            Route::delete('/delete-user/{id}', 'UserController@deleteUser')->name('delete_user');        
        });        
    });
});


