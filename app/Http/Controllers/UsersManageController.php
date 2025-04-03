<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersManageController extends Controller {

    public function testedBy()
    {
        return UsersManageController::class;
    }

    public function index()
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'super_admin' => 'boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'super_admin' => $request->super_admin ?? false
        ]);

        return redirect()->route('users.index')->with('success', 'Usuari creat correctament.');
    }

    public function edit(User $user)
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'super_admin' => 'boolean'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'super_admin' => $request->super_admin ?? false,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'Usuari actualitzat correctament.');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }

        Video::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuari i vídeos eliminats correctament.');
    }
}
