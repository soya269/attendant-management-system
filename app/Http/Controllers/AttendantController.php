<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendantController extends Controller
{
    // Display a listing of the attendants (with search and department filter)
    public function index(Request $request)
    {
        // 2. Use Auth::user() instead of auth()->user()
        $user = Auth::user();
        $search = $request->input('search');

        $query = Attendant::with('department');

        // Filter by authenticated user's department if set
        if ($user && $user->department_id) {
            $query->where('department_id', $user->department_id);
        }

        // Apply name search filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $attendants = $query->get();

        return view('attendants.index', compact('attendants'));
    }

    // Show the form for creating a new attendant
    public function create()
    {
        $departments = Department::all();
        return view('attendants.create', compact('departments'));
    }

    // Store a newly created attendant in storage
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:attendants,email',
            'phone'         => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
        ]);

        Attendant::create($request->all());

        return redirect()->route('attendants.index')->with('success', 'Attendant created successfully.');
    }

    // Show the form for editing the specified attendant
    public function edit(Attendant $attendant)
    {
        $departments = Department::all();
        return view('attendants.edit', compact('attendant', 'departments'));
    }

    // Update the specified attendant in storage
    public function update(Request $request, Attendant $attendant)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:attendants,email,' . $attendant->id,
            'phone'         => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
        ]);

        $attendant->update($request->all());

        return redirect()->route('attendants.index')->with('success', 'Attendant updated successfully.');
    }

    // Remove the specified attendant from storage
    public function destroy(Attendant $attendant)
    {
        $attendant->delete();

        return redirect()->route('attendants.index')->with('success', 'Attendant deleted successfully.');
    }
}