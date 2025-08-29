<?php


namespace App\Http\Controllers\Programs;
use App\Http\Controllers\Controller;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'national_alignment' => 'nullable|string',
            'focus_areas' => 'nullable|string',
            'phases' => 'nullable|string',
        ]);

        Program::create([
            'program_id' => (string) Str::uuid(),
        ] + $request->all());

        return redirect()->route('programs.index')
                         ->with('success','Program created successfully.');
    }


    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'national_alignment' => 'required|string',
            'focus_areas' => 'required|string',
            'phases' => 'required|string',
        ]);

        $program->update($request->except('program_id'));

        return redirect()->route('programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}

