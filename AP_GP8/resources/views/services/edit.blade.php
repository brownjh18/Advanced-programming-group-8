@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Service</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('services.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('services.update', $service->service_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="facility_id"><strong>Facility:</strong></label>
                <select name="facility_id" id="facility_id" class="form-control" required>
                    @foreach ($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ (string) $facility->id === (string) $service->facility_id ? 'selected' : '' }}>{{ $facility->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><strong>Name:</strong></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $service->name }}" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="description"><strong>Description:</strong></label>
                <textarea name="description" id="description" class="form-control" style="height: 100px">{{ $service->description }}</textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="category"><strong>Category:</strong></label>
                <input type="text" name="category" id="category" class="form-control" value="{{ $service->category }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="skill_type"><strong>Skill Type:</strong></label>
                <input type="text" name="skill_type" id="skill_type" class="form-control" value="{{ $service->skill_type }}" required>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endsection
