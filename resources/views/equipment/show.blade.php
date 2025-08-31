@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Equipment</h2>
        </div>
        <div class="pull-right d-flex gap-2">
            <a class="btn btn-primary" href="{{ route('equipment.index') }}"> Back</a>
            <a class="btn btn-warning" href="{{ route('equipment.edit', $equipment->equipment_id) }}"> Edit</a>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <strong>Name:</strong>
                    <div>{{ $equipment->name }}</div>
                </div>

                <div class="form-group mt-2">
                    <strong>Facility:</strong>
                    <div>{{ optional($equipment->facility)->name }}</div>
                </div>

                <div class="form-group mt-2">
                    <strong>Inventory Code:</strong>
                    <div>{{ $equipment->inventory_code }}</div>
                </div>

                <div class="form-group mt-2">
                    <strong>Usage Domain:</strong>
                    <div>{{ $equipment->usage_domain }}</div>
                </div>

                <div class="form-group mt-2">
                    <strong>Support Phase:</strong>
                    <div>{{ $equipment->support_phase }}</div>
                </div>

                <div class="form-group mt-2">
                    <strong>Capabilities:</strong>
                    <div class="border p-2">{!! nl2br(e($equipment->capabilities)) !!}</div>
                </div>

                <div class="form-group mt-2">
                    <strong>Description:</strong>
                    <div class="border p-2">{!! nl2br(e($equipment->description)) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
