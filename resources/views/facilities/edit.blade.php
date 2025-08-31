@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Facility</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('facilities.index') }}"> Back</a>
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
  
    <form action="{{ route('facilities.update', $facility->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{-- FIX: Add the value attribute --}}
                    <input type="text" name="name" value="{{ $facility->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Location:</strong>
                     {{-- FIX: Add the value attribute --}}
                    <input type="text" name="location" value="{{ $facility->location }}" class="form-control" placeholder="Geographic Location">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{-- FIX: Place the content inside the textarea tags --}}
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $facility->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Partner Organization:</strong>
                     {{-- FIX: Add the value attribute --}}
                    <input type="text" name="partner_organization" value="{{ $facility->partner_organization }}" class="form-control" placeholder="e.g. UniPod, UIRI, Lwera">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Facility Type:</strong>
                     {{-- FIX: Add the value attribute --}}
                    <input type="text" name="facility_type" value="{{ $facility->facility_type }}" class="form-control" placeholder="e.g. Lab, Workshop, Testing Center">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Capabilities:</strong>
                    {{-- FIX: Place the content inside the textarea tags --}}
                    <textarea class="form-control" style="height:100px" name="capabilities" placeholder="e.g. CNC, PCB fabrication, materials testing">{{ $facility->capabilities }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection