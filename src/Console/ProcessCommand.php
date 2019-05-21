<?php
/**
 * Created by PhpStorm.
 * User: traian
 * Date: 4/30/19
 * Time: 4:20 PM
 */

namespace mihaicebotari\laravelasterisk\Console;


use Illuminate\Console\Command;

class ProcessCommand extends Command
{
    protected $signature = 'laravel-asterisk:process';

    protected $description = 'Laravel Asterisk check and processing!';

    public function handle(){
        dd("task ok ");
    }

}