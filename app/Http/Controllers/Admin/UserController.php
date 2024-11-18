<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    public function index() : View
    {
        $users = User::all(); // Fetch all users with their roles
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user) : View
    {
        $roles = ['admin', 'manager', 'staff']; // Example roles
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) : RedirectResponse
    {
        $request->validate([
            'role' => 'required|string',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    public function destroy(User $user) : RedirectResponse
    {
        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (Throwable $e) {
            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user.');
        }
    }
}