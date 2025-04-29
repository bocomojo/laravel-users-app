<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
    
    // Handle the delete action
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}

