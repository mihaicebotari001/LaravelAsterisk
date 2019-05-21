<?php

Route::group([
    'namespace' => 'mihaicebotari001\laravel-asterisk\Http\Controllers',
    'prefix' => config('TaskManager.prefix'),
    'middleware' => ['web', 'auth']
],
    function(){
//        Route::get('asterisk/list/view', 'BaseController@index')->name('taskmanagerView');
    }
);
