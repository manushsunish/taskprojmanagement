<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function assignedTasks() :View
    {
        $tasks = auth()->user()->tasks;
        return view('manager.tasks.index', compact('tasks'));
    }
}