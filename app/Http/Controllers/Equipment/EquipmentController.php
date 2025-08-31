<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EquipmentController extends Controller
{
    /**
     * List all equipment with optional search by capability or usage domain.
     */
    public function index(Request $request)
    {
        $query = Equipment::query();

        if ($search = $request->string('search')->trim()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('capabilities', 'like', "%{$search}%")
                  ->orWhere('usage_domain', 'like', "%{$search}%");
            });
        }

        $equipment = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('equipment.index', compact('equipment'));
    }

    /**
     * List all equipment at a specific facility with optional search.
     */
    public function byFacility(Facility $facility, Request $request)
    {
        $query = Equipment::where('facility_id', $facility->id);

        if ($search = $request->string('search')->trim()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('capabilities', 'like', "%{$search}%")
                  ->orWhere('usage_domain', 'like', "%{$search}%");
            });
        }

        $equipment = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('equipment.index', [
            'equipment' => $equipment,
            'facility' => $facility,
        ]);
    }

    /**
     * Show the form for creating new equipment.
     */
    public function create()
    {
        $facilities = Facility::orderBy('name')->get(['id', 'name']);
        return view('equipment.create', compact('facilities'));
    }

    /**
     * Store a newly created equipment record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id'   => ['required', 'integer', 'exists:facilities,id'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'capabilities'  => ['nullable', 'string'],
            'inventory_code'=> ['nullable', 'string', 'max:255'],
            'usage_domain'  => ['required', 'string', 'in:Electronics,Mechanical,IoT'],
            'support_phase' => ['required', 'string', 'in:Training,Prototyping,Testing,Commercialization'],
        ]);

        Equipment::create([
            'equipment_id' => (string) Str::uuid(),
        ] + $validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment created successfully.');
    }

    /**
     * Show the form for editing the specified equipment.
     */
    public function edit(Equipment $equipment)
    {
        $facilities = Facility::orderBy('name')->get(['id', 'name']);
        return view('equipment.edit', compact('equipment', 'facilities'));
    }

    /**
     * Update the specified equipment.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'facility_id'   => ['required', 'integer', 'exists:facilities,id'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'capabilities'  => ['nullable', 'string'],
            'inventory_code'=> ['nullable', 'string', 'max:255'],
            'usage_domain'  => ['required', 'string', 'in:Electronics,Mechanical,IoT'],
            'support_phase' => ['required', 'string', 'in:Training,Prototyping,Testing,Commercialization'],
        ]);

        $equipment->update($validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    /**
     * Display the specified equipment details.
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Remove the specified equipment from storage.
     * If in future equipment is tied to active projects via a relation,
     * add a guard here to prevent deletion when in use.
     */
    public function destroy(Equipment $equipment)
    {
        // Placeholder for future constraint e.g., if ($equipment->projects()->active()->exists()) { ... }
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}
