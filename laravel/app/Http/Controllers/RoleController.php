<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 3);

        $rolesQuery = Role::query()
            ->when($request->filled('id'), fn($q) => $q->where('id', $request->input('id')))
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', '%' . $request->input('name') . '%'));

        $roles = $rolesQuery->paginate($perPage)->appends($request->query());

        return view('roles.index', compact('roles', 'perPage'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('roles.create');
    }

    /**

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Роль успішно додана.');
    }

    /**
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Роль успішно оновлена.');
    }

    /**
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')->with('error', 'Неможливо видалити роль, яка має користувачів.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Роль успішно видалена.');
    }
}
