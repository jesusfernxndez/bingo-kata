<?php

    use Illuminate\Support\Facades\Route;

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

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    /* Token: route for test routes post */
    Route::get('/token', function () {
        return csrf_token();
    });

    /* Routes Game */
    Route::get('/games', 'GameController@get')->name('games');
    Route::get('/games_active', 'GameController@getActiveGames')->name('games_active');
    Route::post('/new_game', 'GameController@save')->name('new_game');
    Route::post('/new_number/{id_game}', 'GameController@number')->name('new_number');
    Route::post('/bingo/{id_game}', 'GameController@bingo')->name('bingo');
    Route::post('/bingo_complete/{id_game}', 'GameController@bingo_complete')->name('bingo_complete');

    /* Routes Card */
    Route::get('/card', 'CardController@get')->name('card');
    Route::get('/card/{id_game}', 'CardController@getPerGame')->name('cardsPerGame');
    Route::post('/new_card/{id_game}', 'CardController@save')->name('new_card');
