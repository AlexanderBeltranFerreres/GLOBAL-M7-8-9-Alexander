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

    // Llista tots els usuaris
    public function index()
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Mostra el formulari de creació d'usuari
    public function create()
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }
        return view('users.create');
    }

    // Guarda un nou usuari
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

    // Mostra el formulari d'edició d'un usuari
    public function edit(User $user)
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per gestionar usuaris.');
        }
        return view('users.edit', compact('user'));
    }

    // Actualitza un usuari
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

    // Elimina un usuari i reassigna els seus vídeos a un usuari per defecte
    public function destroy(User $user)
    {
        if ($user->super_admin) {
            return redirect()->route('users.index')->with('error', 'No pots eliminar un superadministrador.');
        }

        $defaultUser = User::where('super_admin', true)->first();

        if ($defaultUser) {
            Video::where('user_id', $user->id)->update(['user_id' => $defaultUser->id]);
        } else {
            Video::where('user_id', $user->id)->delete();
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuari eliminat correctament.');
    }
}
