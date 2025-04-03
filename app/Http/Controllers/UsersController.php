<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('videos')->firstOrFail();
        return view('users.show', compact('user'));
    }
}
