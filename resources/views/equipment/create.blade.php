@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Equipment</h2>
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

<form action="{{ route('equipment.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Facility:</strong>
                <select name="facility_id" class="form-control" required>
                    <option value="">-- Select Facility --</option>
                    @foreach ($facilities as $f)
                        <option value="{{ $f->id }}" @selected(old('facility_id') == $f->id)>{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Equipment name" required>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" placeholder="Overview of equipment purpose">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Capabilities:</strong>
                <textarea class="form-control" name="capabilities" placeholder="Functions it can perform">{{ old('capabilities') }}</textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Inventory Code:</strong>
                <input type="text" name="inventory_code" value="{{ old('inventory_code') }}" class="form-control" placeholder="Tracking code">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usage Domain:</strong>
                <select name="usage_domain" class="form-control" required>
                    <option value="">-- Select Usage Domain --</option>
                    @foreach (['Electronics','Mechanical','IoT'] as $opt)
                        <option value="{{ $opt }}" @selected(old('usage_domain') == $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Support Phase:</strong>
                <select name="support_phase" class="form-control" required>
                    <option value="">-- Select Support Phase --</option>
                    @foreach (['Training','Prototyping','Testing','Commercialization'] as $opt)
                        <option value="{{ $opt }}" @selected(old('support_phase') == $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
