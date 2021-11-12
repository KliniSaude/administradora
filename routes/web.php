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

/**
 * LOGIN
 */
Route::get('/', 'LoginController@showLoginForm')->name('admin.login');
Route::post('/login/do', 'LoginController@login')->name('admin.login.do');
Route::middleware(['auth'])->group(function () {
  /**
   * DASHBOARD
   */
  Route::get('/dashboard', 'Admin\\ProposeController@dashboard')->name('admin.dashboard');
  Route::get('/proposta/{id}', 'Admin\\ProposeController@show')->name('admin.propostas');

  /**
   * Proposta
   */
  Route::get('nova-proposta', 'Admin\\ProposeController@create')->name('admin.create.proposta');
  Route::post('/cadastrar', 'Admin\\ProposeController@store')->name('admin.store.proposta');


});
/**
 * LOGOUT
 */
Route::get('/logout', 'LoginController@logout')->name('admin.logout');
