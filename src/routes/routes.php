<?php

Route::group([
    'namespace' => 'mihaicebotari001\laravelasterisk\Http\Controllers',
    'prefix' => config('LaravelAsterisk.prefix'),
    'middleware' => ['web', 'auth']
],
    function(){
//        Route::get('laravelasterisk/list/view', 'BaseController@index')->name('laravelasteriskView');
    }
);
