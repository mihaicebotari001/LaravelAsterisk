<?php 

namespace traian321\TaskManager\Facades;

use Illuminate\Support\Facades\Facade;

class TaskManager extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'traian321\TaskManager\Base';
    }
}