<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

Route::get('/', 'DomainController@create')->name('create');

Route::get('/domains', 'DomainController@index')->name('index');

Route::get('/domains/{id}', 'DomainController@show')->name('show');

Route::post('/domains', 'DomainController@store')->name('store');

Route::post('/domains/{id}/checks', function ($id) {
    DB::table('domain_checks')->insert(
        [
            'domain_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
    );
    flash('Website has been checked!');
    return redirect()->route('show', ['id' => $id]);
})->name('checks.store');
