<?php

namespace App\Http\Controllers\participants;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of participants.
     */
    public function index()
    {
        $participants = Participant::orderBy('full_name')->get();
        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new participant.
     */
    public function create()
    {
        $affiliations = Participant::AFFILIATIONS;
        $specializations = Participant::SPECIALIZATIONS;
        $institutions = Participant::INSTITUTIONS;
        $participantTypes = Participant::PARTICIPANT_TYPES;
        $projects = Project::with('program')->orderBy('title')->get();
        return view('participants.create', compact('affiliations', 'specializations', 'institutions', 'participantTypes', 'projects'));
    }

    /**
     * Store a newly created participant in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants,email',
            'affiliation' => 'required|string|in:' . implode(',', Participant::AFFILIATIONS),
            'specialization' => 'required|string|in:' . implode(',', Participant::SPECIALIZATIONS),
            'participant_type' => 'required|string|in:' . implode(',', Participant::PARTICIPANT_TYPES),
            'cross_skill_trained' => 'sometimes|boolean',
            'institution' => 'required|string|in:' . implode(',', Participant::INSTITUTIONS),
            'project_id' => 'nullable|string|exists:projects,project_id',
        ]);

        $validated['cross_skill_trained'] = (bool) ($validated['cross_skill_trained'] ?? false);

        $data = $validated;
        unset($data['project_id']);

        $participant = Participant::create(['participant_id' => (string) Str::uuid()] + $data);

        if (!empty($validated['project_id'])) {
            $participant->projects()->syncWithoutDetaching([$validated['project_id']]);
        }

        return redirect()->route('participants.index')->with('success', 'Participant created successfully.');
    }

    /**
     * Display the specified participant profile with their projects.
     */
    public function show(Participant $participant)
    {
        $participant->load('projects');
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the participant.
     */
    public function edit(Participant $participant)
    {
        $affiliations = Participant::AFFILIATIONS;
        $specializations = Participant::SPECIALIZATIONS;
        $institutions = Participant::INSTITUTIONS;
        $participantTypes = Participant::PARTICIPANT_TYPES;
        return view('participants.edit', compact('participant', 'affiliations', 'specializations', 'institutions', 'participantTypes'));
    }

    /**
     * Update the participant in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants,email,' . $participant->participant_id . ',participant_id',
            'affiliation' => 'required|string|in:' . implode(',', Participant::AFFILIATIONS),
            'specialization' => 'required|string|in:' . implode(',', Participant::SPECIALIZATIONS),
            'participant_type' => 'required|string|in:' . implode(',', Participant::PARTICIPANT_TYPES),
            'cross_skill_trained' => 'sometimes|boolean',
            'institution' => 'required|string|in:' . implode(',', Participant::INSTITUTIONS),
        ]);

        $validated['cross_skill_trained'] = (bool) ($validated['cross_skill_trained'] ?? false);

        $participant->update($validated);

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully.');
    }

    /**
     * Remove the participant from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Participant deleted successfully.');
    }

    /**
     * Assign a participant to a project.
     */
    public function assignToProject(Request $request, Participant $participant)
    {
        $data = $request->validate([
            'project_id' => 'required|string|exists:projects,project_id',
        ]);

        $participant->projects()->syncWithoutDetaching([$data['project_id']]);

        return redirect()->route('participants.show', $participant->participant_id)
            ->with('success', 'Participant assigned to project successfully.');
    }

    /**
     * Remove a participant from a project.
     */
    public function removeFromProject(Participant $participant, Project $project)
    {
        $participant->projects()->detach($project->project_id);

        return redirect()->route('participants.show', $participant->participant_id)
            ->with('success', 'Participant removed from project successfully.');
    }
}
