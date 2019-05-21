<?php
/**
 * Created by PhpStorm.
 * User: traian
 * Date: 4/30/19
 * Time: 3:17 PM
 */

namespace traian321\TaskManager\Http\Controllers;


use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function index(){
        return view('TaskManager::index');
    }

}