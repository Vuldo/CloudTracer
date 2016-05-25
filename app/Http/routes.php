<?php

use GrahamCampbell\DigitalOcean\Facades\DigitalOcean;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', array('as' => 'droplet-home', 'uses' => 'DropletController@getIndex'));
Route::get('/refresh/{id}', array('as' => 'droplet-refresh', 'uses' => 'DropletController@getRefresh'));
Route::get('/delete/{id}', array('as' => 'droplet-delete', 'uses' => 'DropletController@getDelete'));
Route::get('/create', array('as' => 'droplet-create', 'uses' => 'DropletController@getCreate'));