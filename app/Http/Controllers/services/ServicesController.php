<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    /**
     * Display a listing of services. Supports optional category filter via query string (?category=machining).
     */
    public function index(Request $request)
    {
        $query = Services::with('facility');

        if ($request->filled('category')) {
            $query->where('category', 'LIKE', '%'.$request->query('category').'%');
        }

        $services = $query->get();

        return view('services.index', compact('services'));
    }

    /**
     * Display services for a specific facility.
     */
    public function byFacility(Facility $facility)
    {
        $facility->load('services');
        return view('services.by-facility', compact('facility'));
    }

    /**
     * Show the form for creating a new service. Optionally preselect a facility via ?facility_id=ID
     */
    public function create(Request $request)
    {
        $facilities = Facility::all(['id', 'name']);
        $selectedFacility = $request->query('facility_id');
        return view('services.create', compact('facilities', 'selectedFacility'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|integer|exists:facilities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'skill_type' => 'required|string|max:255',
        ]);

        Services::create(['service_id' => (string) Str::uuid()] + $validated);

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service.
     */
    public function show(Services $service)
    {
        $service->load('facility');
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Services $service)
    {
        $facilities = Facility::all(['id', 'name']);
        return view('services.edit', compact('service', 'facilities'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Services $service)
    {
        $validated = $request->validate([
            'facility_id' => 'required|integer|exists:facilities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'skill_type' => 'required|string|max:255',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Services $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
