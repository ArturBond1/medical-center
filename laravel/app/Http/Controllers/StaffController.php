<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $staffMembers = Staff::with('user', 'department')->paginate(10);
        return view('staff.index', compact('staffMembers'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $users = User::whereDoesntHave('staff')->get()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id'); // Get all departments
        return view('staff.create', compact('users', 'departments'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:staff',
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
        ]);

        Staff::create($request->all());

        return redirect()->route('staff.index')->with('success', 'Працівника успішно додано.');
    }

    /**
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    /**
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Staff $staff)
    {
        $users = User::all()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id'); // Get all departments
        return view('staff.edit', compact('staff', 'users', 'departments'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'user_id' => 'required|unique:staff,user_id,' . $staff->id,
            'department_id' => 'required|exists:departments,id', // Validate department_id
            'position' => 'required|string|max:255',
        ]);

        $staff->update($request->all());

        return redirect()->route('staff.index')->with('success', 'Інформацію про працівника успішно оновлено.');
    }

    /**
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Працівника успішно видалено.');
    }
}

