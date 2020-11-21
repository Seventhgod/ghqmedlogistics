<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Projects'], function () {
        // views
        Route::group(['prefix' => 'projects'], function () {
            Route::view('/', 'projects.index');
            Route::view('/create', 'projects.create');
            Route::view('/{project}/edit', 'projects.edit');
            Route::get('/{project}/show', 'ProjectsController@show');
            Route::get('/{id}/projectdetails', 'ProjectsController@projectdetails')->name('projectdetails.index');
            Route::get('/{project}/addrequest', 'ProjectsController@addRequest');
            Route::get('getItemName/{category}', 'ProjectsController@getItem');
            Route::post('/projectstore', 'ProjectsController@store')->name('projects.store');
            Route::get('/index', 'ProjectsController@index')->name('projects.index');
        });

        Route::group(['prefix' => 'api/projects'], function() {
            Route::get('/count', 'ProjectsController@count');
            Route::post('/filter', 'ProjectsController@filter');
            Route::post('/store', 'ProjectsController@store');
            Route::get('/getProject/{project}', 'ProjectsController@getProject');
            Route::put('/update/{project}', 'ProjectsController@update');
            Route::delete('/{project}', 'ProjectsController@destroy');
        });
    });
});

