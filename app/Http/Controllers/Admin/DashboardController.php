<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index() :View
    {
        $projectsPendingCount = Project::where('status', 'pending')->count();
        $tasksPendingCount = Task::where('status', 'pending')->count();
        $managersCount = User::where('role', 'manager')->count();
        $staffCount = User::where('role', 'staff')->count();
        $totalProjectsCount = Project::count();
        $totalTasksCount = Task::count();
        $projects = Project::with('team')->get();  // Get all projects with team members

        // Optionally, if you want to get tasks or other relevant data, you can add more queries:
        $tasks = Task::all();  // Example: Get all tasks
        $users = User::all();

        return view('admin.dashboard', compact(
            'projectsPendingCount', 'tasksPendingCount', 'managersCount', 'staffCount',
            'totalProjectsCount', 'totalTasksCount','projects','tasks','users'
        ));
    }
}
