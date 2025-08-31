@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Service</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('services.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $service->name }}
        </div>
        <div class="form-group">
            <strong>Facility:</strong>
            {{ optional($service->facility)->name }}
        </div>
        <div class="form-group">
            <strong>Description:</strong>
            {{ $service->description }}
        </div>
        <div class="form-group">
            <strong>Category:</strong>
            {{ $service->category }}
        </div>
        <div class="form-group">
            <strong>Skill Type:</strong>
            {{ $service->skill_type }}
        </div>
    </div>
</div>
@endsection
