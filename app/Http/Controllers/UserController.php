<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;                // ✅ import Spatie Role
use Spatie\Permission\PermissionRegistrar;        // ✅ to clear cache

class UserController extends Controller
{
    public function __construct()
    {
        // Only logged-in admins can hit ANY action in this controller
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

        $roles = Role::all();   // ✅ fetch all roles for dropdown

        return view('users', compact('users', 'search', 'roles'));   // ✅ pass roles
    }

    // Show the edit form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update user role (with protection)
    // Update user role (with protection)
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        if ($user->id == 1) {
            return back()->with('error', 'Cannot change the super admin role.');
        }

        // clear cached permissions
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // assign new role
        $user->syncRoles([$request->role]);

        // 👉 if role is Pre-auditor, insert/update in pre_auditors
        if (strtolower($request->role) === 'pre-auditor') {
            \App\Models\PreAuditor::updateOrCreate(
                ['user_id' => $user->id], // condition
                ['name' => $user->name]   // values
            );
        } else {
            // 👉 optional: if user is no longer a pre-auditor, remove them
            \App\Models\PreAuditor::where('user_id', $user->id)->delete();
        }

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
