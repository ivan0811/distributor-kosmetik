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
Route::post('/get-kabupaten', 'APIController@getKabupatenReq')->name('get_kabupaten');
Route::post('/get-kecamatan', 'APIController@getKecamatan')->name('get_kecamatan');

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

    //transaksi
    Route::prefix('/transaksi')->group(function(){
        Route::get('/', 'TransaksiController@transaksi')->name('transaksi');   
        Route::get('/create-transaksi', 'TransaksiController@createTransaksi')->name('create_transaksi');
    });
    
    //crud pemasok
    Route::prefix('/pemasok')->group(function(){
        Route::get('/', 'PemasokController@pemasok')->name('pemasok');
        Route::get('/create-pemasok', 'PemasokController@createPemasok')->name('create_pemasok');
        Route::post('/store-pemasok', 'PemasokController@storePemasok')->name('store_pemasok');
        Route::get('/edit-pemasok/{kode_pabrik}', 'PemasokController@editPemasok')->name('edit_pemasok');
        Route::patch('/update-pemasok', 'PemasokController@updatePemasok')->name('update_pemasok');
        Route::delete('/delete-pemasok/{kode_pabrik}', 'PemasokController@deletePemasok')->name('delete_pemasok'); 
    });

    //crud barang
    Route::prefix('/barang')->group(function(){
        Route::get('/', 'BarangController@barang')->name('barang');
        Route::get('/create-barang', 'BarangController@createBarang')->name('create_barang');
        Route::post('/store-barang', 'BarangController@storeBarang')->name('store_barang');
        Route::get('/edit-barang/{id}', 'BarangController@editBarang')->name('edit_barang');
        Route::patch('/update-barang', 'BarangController@updateBarang')->name('update_barang');
        Route::delete('/delete-barang/{id}', 'BarangController@deleteBarang')->name('delete_barang');
        // barang masuk
        Route::get('/create-barang-masuk', 'BarangController@createBarangMasuk')->name('create_barang_masuk');
        Route::post('/store-barang-masuk', 'BarangController@storeBarangMasuk')->name('store_barang_masuk');
        Route::get('/edit-barang-masuk/{kode_pabrik}', 'BarangController@editBarangMasuk')->name('edit_barang_masuk');
        Route::patch('/update-barang-masuk', 'BarangController@updateBarangMasuk')->name('update_barang_masuk');
        Route::delete('/delete-barang-masuk/{kode_pabrik}', 'BarangController@deleteBarangMasuk')->name('delete_barang_masuk');
        // barang keluar
        Route::get('/create-barang-keluar', 'BarangController@createBarangKeluar')->name('create_barang_keluar');
        Route::post('/store-barang-keluar', 'BarangController@storeBarangKeluar')->name('store_barang_keluar');
        Route::get('/edit-barang-keluar/{id}', 'BarangController@editBarangKeluar')->name('edit_barang_keluar');
        Route::patch('/update-barang-keluar', 'BarangController@updateBarangKeluar')->name('update_barang_keluar');
        Route::delete('/delete-barang-keluar/{id}', 'BarangController@deleteBarangKeluar')->name('delete_barang_keluar');
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

        Route::prefix('/laporan')->group(function(){
            Route::get('/', 'LaporanController@laporan')->name('laporan');
        });
    });
    });


