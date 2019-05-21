<?php
/**
 * Created by PhpStorm.
 * User: traian
 * Date: 4/30/19
 * Time: 4:20 PM
 */

namespace traian321\TaskManager\Console;


use Illuminate\Console\Command;

class ProcessCommand extends Command
{
    protected $signature = 'taskmanager:process';

    protected $description = 'TaskManager check and processing!';

    public function handle(){
        dd("task ok ");
    }

}