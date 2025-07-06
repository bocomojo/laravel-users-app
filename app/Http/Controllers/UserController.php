<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        public function __construct()
    {
        // Only logged‑in admins can hit ANY action in this controller
        $this->middleware(['auth', 'role:admin']);
    }
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, fn ($query) =>
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(10);

        return view('users', compact('users', 'search'));
    }

    // Show the edit form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update user role (with protection)
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:admin,staff,user',
        ]);

        // Remove existing roles
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'User role updated.');
    }

    // Handle the update logic
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['name', 'email']));

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Handle the delete action (with protection)
    public function destroy(User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('users.index')->with('error', 'Cannot delete the super admin.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
