<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::middleware('auth:api')->group(function () {
    
    Route::post('/logout', 'Api\AuthController@logout');

    Route::get('user', function (Request $request) {
        return User::get();
    });

    Route::apiResource('users', 'Api\UserController');

});
