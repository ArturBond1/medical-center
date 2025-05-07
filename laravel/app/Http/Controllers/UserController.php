<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 3);

        $usersQuery = User::with('role')
            ->when($request->filled('id'), fn($q) => $q->where('id', $request->input('id')))
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', '%' . $request->input('name') . '%'))
            ->when($request->filled('email'), fn($q) => $q->where('email', 'like', '%' . $request->input('email') . '%'))
            ->when($request->filled('role_id'), fn($q) => $q->where('role_id', $request->input('role_id')));

        $users = $usersQuery->paginate($perPage)->appends($request->query());

        $roles = Role::all();

        return view('users.index', compact('users', 'roles', 'perPage'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Користувача успішно додано.');
    }

    /**
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $user->load('role');
        return view('users.show', compact('user'));
    }

    /**
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'Користувача успішно оновлено.');
    }

    /**
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Користувача успішно видалено.');
    }
}

