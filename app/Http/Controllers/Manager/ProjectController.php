<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function assignedProjects() :View
    {
        $projects = \App\Models\Project::where('manager_id', auth()->id())->get();
        return view('manager.projects.index', compact('projects'));
    }
}