<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

    Route::group(['prefix' => 'friend', 'namespace' => 'Friend'], function () {

        Route::get('', 'ListController@index');

        Route::delete('/{id}', 'DestroyController@destroy');

        Route::post('/{id}', 'StoreController@main');
    });
    
    Route::group(['prefix' => 'friend-request', 'namespace' => 'FriendRequest'], function () {

            Route::get('', 'ListController@index');

            Route::put('/{id}', 'AcceptController@main');

            Route::delete('/{id}', 'RejectController@main');
    });

    Route::group([
        'prefix' => 'message-personal',
        'namespace' => 'messagePersonal'
    ], function () {

        Route::get('/{id}', 'IndexController@main');

        Route::post('', 'StoreController@main');
    });

    Route::group(['prefix' => 'profile', 'namespace'=>'Profile'], function () {

        Route::get('', 'IndexController@main');

        Route::put('', 'UpdateController@main');
    });

    Route::group(['prefix' => 'user', 'namespace'=>'User'], function () {

            Route::get('profile/{id}', 'ProfileController@show');
    });

    Route::group(['prefix' => 'room', 'namespace' => 'Room'], function () {

        Route::get('', 'ListController@main');

        Route::post('', 'StoreController@main');
    });

    Route::group(['prefix' => 'search', 'namespace'=>'Search'], function () {

        Route::group(['prefix' => 'user', 'namespace'=>'User'], function () {

            Route::get('', 'IndexController@main');
        });
    });
});
