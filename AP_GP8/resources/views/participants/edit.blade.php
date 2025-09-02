@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Participant</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('participants.update', $participant->participant_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $participant->full_name) }}" required>
        </div>
        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $participant->email) }}" required>
        </div>
        <div class="form-group mb-2">
            <label>Affiliation</label>
            <select name="affiliation" class="form-control" required>
                <option value="">Select</option>
                @foreach ($affiliations as $a)
                    <option value="{{ $a }}" {{ old('affiliation', $participant->affiliation) === $a ? 'selected' : '' }}>{{ $a }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Specialization</label>
            <select name="specialization" class="form-control" required>
                <option value="">Select</option>
                @foreach ($specializations as $s)
                    <option value="{{ $s }}" {{ old('specialization', $participant->specialization) === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Participant Type</label>
            <select name="participant_type" class="form-control" required>
                <option value="">Select</option>
                @foreach ($participantTypes as $pt)
                    <option value="{{ $pt }}" {{ old('participant_type', $participant->participant_type) === $pt ? 'selected' : '' }}>{{ $pt }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Institution</label>
            <select name="institution" class="form-control" required>
                <option value="">Select</option>
                @foreach ($institutions as $i)
                    <option value="{{ $i }}" {{ old('institution', $participant->institution) === $i ? 'selected' : '' }}>{{ $i }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-check mb-3">
            <input type="checkbox" name="cross_skill_trained" id="cross_skill_trained" value="1" class="form-check-input" {{ old('cross_skill_trained', $participant->cross_skill_trained) ? 'checked' : '' }}>
            <label class="form-check-label" for="cross_skill_trained">Cross-skill Trained</label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('participants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
