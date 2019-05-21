<?php
namespace traian321\TaskManager;

use Illuminate\Database\Eloquent\Model;
use traian321\TaskManager\Formatter\Formatter;
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

        config([
            'project_columns' => ['projects.id', 'projects.name', 'projects.slug', 'users.id as owner_id', 'users.name as owner', 'projects.created_at', 'projects.updated_at']
        ]);

        config([
            'task_columns' => ['tasks.id', 'tasks.name', 'tasks.slug', 'users.id as author_id', 'users.name as author', 'tasks.completed', 'tasks.description', 'tasks.created_at', 'tasks.updated_at']
        ]);
    }

    /**
     * Set the user id for creating projects and tasks
     * @param int $userId
     * @return null
     */
    public function setUserId($userId)
    {
        $this->userID = $userId;
    }

    /**
     * Get all projects and tasks
     * @return traian321\TaskManager $this
     */
    public function getAll()
    {
        $projects  = (array) DB::table('projects')
            ->join('users', 'users.id', '=', 'projects.owner')
            ->get(config('project_columns'));
        $c = 0;
        foreach($projects as $project){
            $this->projects[$c] = (array) $project;
            $tasks = (array) DB::table('tasks')
                ->where('project_id', $project[$c]->id)
                ->join('users', 'users.id', '=', 'tasks.author')
                ->get(config('task_columns'));
            foreach($tasks as $task){
                $this->projects[$c]['tasks'][] = (array) $task;
            }
            $c++;
        }

        return $this;
    }

    /**
     * Get a project with given projectId
     *
     * @param mixed $projectId
     * @return traian321\TaskManager $this
     */
    public function getProject($projectId)
    {
        $project = DB::table('projects')
            ->where('projects.id', $projectId)
            ->join('users', 'users.id', '=', 'projects.owner')
            ->first(config('project_columns'));

        $projectCount = array($project);

        if(count($projectCount) == 0){
            return ['error' => 'project not found'];
        }

        foreach($project as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * Get whole projects
     * @return traian321\TaskManager $this
     */
    public function getProjects()
    {
        $projects = DB::table('projects')
            ->join('users', 'users.id', '=', 'projects.owner')
            ->get(config('project_columns'));
        foreach($projects as $project) {
            $this->projects[] = (array)$project;
        }

        return $this;
    }

    /**
     * Get all tasks, with or without project id. Get the project ID from $this->id,
     * which is created when chaining methods together for example:
     *
     * TaskManager::addProject($project_details)->addTask($task_details)
     *
     * @return traian321\TaskManager $this
     */
    public function getTasks($projectId)
    {

        if(isset($projectId)){
            $tasks = DB::table('tasks')
                ->where('project_id', $projectId)
                ->join('users', 'users.id', '=', 'tasks.author')
                ->get(config('task_columns'));
            foreach($tasks as $task) {
                $this->tasks[] = (array)$task;
            }
        }else{
            return ['error pls specific project id'];
        }


        return $this;
    }

    /**
     * Get a specific task by task id
     *
     * @param mixed $taskId
     * @return traian321\TaskManager $this
     */
    public function getTask($taskId)
    {
        $this->task = (array)DB::table('tasks')
            ->where('project_id', $this->id)
            ->where('tasks.id', $taskId)->join('users', 'users.id', '=', 'tasks.author')
            ->first(config('task_columns'));
        return $this;
    }

    /**
     * Create a project
     *
     * @param mixed|array $details
     * @return traian321\TaskManager $this
     */
    public function addProject(array $details)
    {
        if(!isset($details['slug']))
        {
            $details['slug'] = '';
        }

        $this->result = DB::table('projects')->insert(
            [
                'name' => $details['name'],
                'slug' => $details['slug'], //optional
                'owner' => $this->userID,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ]
        );

        $this->project_id = $this->getLastInsertId();
        Session(['last_project_id', $this->project_id]);

        return $this;
    }

    /**
     * Create a task
     *
     * @param mixed|array $details
     * @return traian321\TaskManager $this
     */
    public function addTask(array $details)
    {

        // Use the default slug
        if(!isset($details['slug']))
        {
            $details['slug'] = '';
        }

        // Use the default description
        if(!isset($details['description']))
        {
            $details['description'] = '';
        }

        // Use the newest created project_id
        if(!isset($details['project_id']))
        {
            if(!isset($this->project_id))
            {
                //todo
                $details['project_id'] = Session::get('last_project_id');
            }
            else
            {
                $details['project_id'] = $this->project_id;
            }

        }

        $this->result = DB::table('tasks')->insert(
            [
                'project_id' => $details['project_id'],
                'name' => $details['name'],
                'slug' => $details['slug'],
                'author' => $this->userID,
                'completed' => 0,
                'description' => $details['description'],
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ]
        );

        $this->task_id[] = $this->getLastInsertId();

        return $this;
    }

    /**
     * Formats the project / task (traian321\TaskManager)
     * @returns traian321\TaskManager\Formatter\Formatter $formated
     */
    public function format()
    {
        return $formated = new Formatter($this);
    }

    /**
     * Delete a project
     * $return int $rows_deleted
     */
    public function deleteProject($projectId)
    {
        $rows_deleted = DB::table('projects')->where('id', '=', $projectId)->delete();
        return $rows_deleted;
    }

    /**
     * Delete a task
     * $return int $rows_deleted
     */
    public function deleteTask($taskId)
    {
        $rows_deleted = DB::table('tasks')->where('id', '=', $taskId)->delete();
        return $rows_deleted;
    }

    /**
     * Mark a task as completed
     * $return int $rows_affected
     */
    public function completeTask($taskId)
    {
        $rows_affected = DB::table('tasks')
            ->where('id', $taskId)
            ->update(['completed' => 1]);
        return $rows_affected;
    }

    /**
     * !!TODO!!
     * Helper method to get the last insert id
     */
    private function getLastInsertId()
    {
        $lid = json_decode(json_encode(DB::select('SELECT LAST_INSERT_ID()')), true);
        $lastInsertId = $lid[0]['LAST_INSERT_ID()'];
        return $lastInsertId;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}