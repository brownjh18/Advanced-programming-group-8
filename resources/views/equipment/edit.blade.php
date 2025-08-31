@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Equipment</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('equipment.index') }}"> Back</a>
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

<form action="{{ route('equipment.update', $equipment->equipment_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Facility:</strong>
                <select name="facility_id" class="form-control" required>
                    @foreach ($facilities as $f)
                        <option value="{{ $f->id }}" @selected(old('facility_id', $equipment->facility_id) == $f->id)>{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ old('name', $equipment->name) }}" class="form-control" required>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description">{{ old('description', $equipment->description) }}</textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Capabilities:</strong>
                <textarea class="form-control" name="capabilities">{{ old('capabilities', $equipment->capabilities) }}</textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Inventory Code:</strong>
                <input type="text" name="inventory_code" value="{{ old('inventory_code', $equipment->inventory_code) }}" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usage Domain:</strong>
                <select name="usage_domain" class="form-control" required>
                    @foreach (['Electronics','Mechanical','IoT'] as $opt)
                        <option value="{{ $opt }}" @selected(old('usage_domain', $equipment->usage_domain) == $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Support Phase:</strong>
                <select name="support_phase" class="form-control" required>
                    @foreach (['Training','Prototyping','Testing','Commercialization'] as $opt)
                        <option value="{{ $opt }}" @selected(old('support_phase', $equipment->support_phase) == $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>

</form>
@endsection
