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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('dashboard');
});
Route::get('/api/adminrequest/changestatus', 'AddDR\AdminDRController@changeStatus');
Route::get('/adminreq/{id}/projectdetails', 'AddDR\AdminDRController@projectdetails');
Route::get('/adminreq/', 'AddDR\AdminDRController@index')->name('adminreq.index');
Route::get('/projecttest', [
    'uses' => 'Projects\ProjectsController@filter'
]);
Route::get('/getrequests', 'AdminDRController@index');
Route::get('filltable', [
    'uses'=>'AdminDRController@index',
    'as'=>'adminfill'
]);
Route::get('/getfilter', 'AddDR\AdminDRController@filter');

Route::get('testIndex', 'AdminDRController@testIndex');
Route::get('/requestcount', 'DrugRequestsController@count');
Route::resource('items', 'ItemsController');
Route::get('/dashboard', 'DashboardController@index')->name('home');

require __DIR__ . '/profile/profile.php';
require __DIR__ . '/users/users.php';
require __DIR__ . '/roles/roles.php';
require __DIR__ . '/roles/permissions.php';
require __DIR__ . '/modules/modules.php';
require __DIR__ . '/projects/projects.php';
require __DIR__ . '/adminrequest/adminrequest.php';


//Route::resource('drugRequests', 'DrugRequestsController');


Route::resource('drugRequests', 'DrugRequestsController');
Route::get('/getReport', 'PDFController@projectpdf');
Route::get('/api/adminreq/getPendingReport', 'PDFController@pendprojects');
Route::get('/{id}/projectItemreq', 'PDFController@projItemReq')->name('projectItemreq.index');
Route::get('/{id}/projectItemexc', 'PDFController@excelReport')->name('projectItemexc.index');


