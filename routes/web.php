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

//middleware auth petugas
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

    //crud toko
    Route::prefix('/toko')->group(function(){
        Route::get('/', 'TokoController@toko')->name('toko');
        Route::get('/create-toko', 'TokoController@createToko')->name('create_toko');
        Route::post('/store-toko', 'TokoController@storeToko')->name('store_toko');
        Route::get('/edit-toko/{id}', 'TokoController@editToko')->name('edit_toko');
        Route::patch('/update-toko', 'TokoController@updateToko')->name('update_toko');
        Route::delete('/delete-toko/{id}', 'TokoController@deleteToko')->name('delete_toko');
    });

    //crud sales
    Route::prefix('/sales')->group(function(){
        Route::get('/', 'SalesController@sales')->name('sales');
        Route::get('/create-sales', 'SalesController@createSales')->name('create_sales');
        Route::post('/store-sales', 'SalesController@storeSales')->name('store_sales');
        Route::get('/edit-sales/{id}', 'SalesController@editSales')->name('edit_sales');
        Route::patch('/update-sales', 'SalesController@updateSales')->name('update_sales');
        Route::delete('/delete-sales/{id}', 'SalesController@deleteSales')->name('delete_sales');
    });

    //crud bank
    Route::prefix('/bank')->group(function(){
        Route::get('/', 'BankController@bank')->name('bank');
        Route::get('/create-bank', 'BankController@createBank')->name('create_bank');
        Route::post('/store-bank', 'BankController@storeBank')->name('store_bank');
        Route::get('/edit-bank/{kode_bank}', 'BankController@editBank')->name('edit_bank');
        Route::patch('/update-bank', 'BankController@updateBank')->name('update_bank');
        Route::delete('/delete-bank/{kode_bank}', 'BankController@deleteBank')->name('delete_bank');
    });

    //crud rekening
    Route::prefix('/rekening')->group(function(){
        Route::get('/', 'RekeningController@rekening')->name('rekening');
        Route::get('/create-rekening', 'RekeningController@createRekening')->name('create_rekening');
        Route::post('/store-rekening', 'RekeningController@storeRekening')->name('store_rekening');
        Route::get('/edit-rekening/{norek}', 'RekeningController@editRekening')->name('edit_rekening');
        Route::patch('/update-rekening', 'RekeningController@updateRekening')->name('update_rekening');
        Route::delete('/delete-rekening/{norek}', 'RekeningController@deleteRekening')->name('delete_rekening');
    });

    //middleware auth admin
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


