<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index()
    {
        $employees = User::where('role', 'employer')->latest()->paginate(20);
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created employee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employer',
            'is_active' => true,
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Employee added successfully!');
    }

    /**
     * Display the specified employee.
     */
    public function show($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee.
     */
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $employee->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Toggle the active status of the employee.
     */
    public function toggleStatus($id)
    {
        $employee = User::findOrFail($id);
        
        if ($employee->is_active) {
            $employee->suspend();
            $message = 'Employee has been paused.';
        } else {
            $employee->activate();
            $message = 'Employee has been activated.';
        }

        return back()->with('success', $message);
    }

    /**
     * Remove the specified employee.
     */
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully!');
    }
}
