<?php

Route::group([
    'namespace' => 'traian321\TaskManager\Http\Controllers',
    'prefix' => config('TaskManager.prefix'),
    'middleware' => ['web', 'auth']
],
    function(){
        Route::get('taskmanager/list/view', 'BaseController@index')->name('taskmanagerView');


        Route::get('taskmanager/list/all', function() {
            return TaskManager::getAll();
        })->name('taskmanagerAllProjectAllTasks');

        Route::get('taskmanager/list/projects', function(){
            return TaskManager::getProjects();
        })->name('taskmanagerAllProjects');

        Route::get('taskmanager/list/project/{project_id}', function($project_id) {
            return TaskManager::getProject($project_id);
        })->name('taskmanagerProject');

        Route::get('taskmanager/list/tasks/{project_id}', function($project_id) {
            return TaskManager::getTasks($project_id);
        })->name('taskmanagerTasksProject');

        Route::get('taskmanager/delete/project/{project_id}', function($project_id) {
            return TaskManager::deleteProject($project_id);
        })->name('taskmanagerDelProject');

        Route::get('taskmanager/delete/task/{task_id}', function($task_id) {
            return TaskManager::deleteTask($task_id);
        })->name('taskmanagerDelTask');

        Route::get('taskmanager/complete/task/{task_id}', function($task_id) {
            return TaskManager::completeTask($task_id);
        })->name('taskmanagerMarkTaskComplet');
    }
);
