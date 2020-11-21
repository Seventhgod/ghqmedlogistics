<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'AddDR'], function () {
        // views
        Route::group(['prefix' => 'adminreq'], function () {
            Route::view('/', 'adminrequest.index');
            Route::view('/create', 'adminrequest.create');
            Route::get('/{adminrequest}/show', 'AdminDRController@show');
            Route::view('/{adminrequest}/edit', 'adminrequest.edit');
            Route::get('/index', 'AdminDRController@index')->name('adminreq.index');
        });

        Route::group(['prefix' => 'api/adminrequest'], function() {
            Route::get('/getUserUnit/', 'AdminDRController@getUserUnit');
            Route::get('/count', 'AdminDRController@count');
            Route::post('/filter', 'AdminDRController@filter');
            Route::get('/getadminrequest/{adminrequest}', 'AdminDRController@getAdminRequest');
            Route::get('/{adminrequest}', 'AdminDRController@show');
            Route::post('/store', 'AdminDRController@store');
            Route::put('/update/{adminrequest}', 'AdminDRController@update');
            Route::delete('/{adminrequest}', 'AdminDRController@destroy');
        });
    });
});


