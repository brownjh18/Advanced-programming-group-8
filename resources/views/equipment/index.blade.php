@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Equipment @isset($facility) for {{ $facility->name }} @endisset</h2>
        </div>
        <div class="pull-right mb-2 d-flex gap-2">
            <form method="GET" action="{{ isset($facility) ? route('facilities.equipment.index', $facility->id) : route('equipment.index') }}" class="form-inline">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, capabilities, usage domain" class="form-control mr-2" />
                <button class="btn btn-secondary" type="submit">Search</button>
            </form>
            <a class="btn btn-success" href="{{ route('equipment.create') }}"> Create New Equipment</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Facility</th>
        <th>Usage Domain</th>
        <th>Support Phase</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($equipment as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="{{ route('equipment.show', $item->equipment_id) }}">{{ $item->name }}</a></td>
        <td>{{ optional($item->facility)->name }}</td>
        <td>{{ $item->usage_domain }}</td>
        <td>{{ $item->support_phase }}</td>
        <td>
            <form action="{{ route('equipment.destroy', $item->equipment_id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('equipment.show', $item->equipment_id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('equipment.edit', $item->equipment_id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this equipment?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $equipment->links() }}
@endsection
