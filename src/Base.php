<?php
namespace mihaicebotari001\LaravelAsterisk;

use Illuminate\Database\Eloquent\Model;
use mihaicebotari001\LaravelAsterisk\Formatter\Formatter;
use DB;
use Carbon;
use Session;

class Base
{
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * @return null
     */
    private function initialize()
    {

//        config([
//            'project_columns' => ['projects.id', 'projects.name', 'projects.slug', 'users.id as owner_id', 'users.name as owner', 'projects.created_at', 'projects.updated_at']
//        ]);
//
//        config([
//            'task_columns' => ['tasks.id', 'tasks.name', 'tasks.slug', 'users.id as author_id', 'users.name as author', 'tasks.completed', 'tasks.description', 'tasks.created_at', 'tasks.updated_at']
//        ]);
    }


    public function __toString()
    {
        return json_encode($this);
    }
}