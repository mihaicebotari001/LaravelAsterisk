<?php 

namespace mihaicebotari001\LaravelAsterisk\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelAsterisk extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'mihaicebotari001\LaravelAsterisk\Base';
    }
}