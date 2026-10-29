<?php
namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\Department;
use Illuminate\Http\Request;

class AttendantController extends Controller
{
    // Display a listing of the attendants
    public function index()
    {
        $attendants = Attendant::with('department')->get();
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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:attendants,email',
        'phone' => 'nullable|string|max:20',
        'department_id' => 'required|exists:departments,id', // Ensures department is selected
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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:attendants,email,' . $attendant->id,
        'phone' => 'nullable|string|max:20',
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