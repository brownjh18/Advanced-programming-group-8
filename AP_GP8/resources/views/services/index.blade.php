@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Services</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('services.create') }}"> Create New Service</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('services.index') }}" class="form-inline">
            <div class="input-group">
                <input type="text" name="category" class="form-control" placeholder="Filter by category (e.g., machining, testing)" value="{{ request('category') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a class="btn btn-secondary" href="{{ route('services.index') }}">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Facility</th>
            <th>Category</th>
            <th>Skill Type</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ optional($service->facility)->name }}</td>
                <td>{{ $service->category }}</td>
                <td>{{ $service->skill_type }}</td>
                <td>
                    <form action="{{ route('services.destroy', $service->service_id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('services.show', $service->service_id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('services.edit', $service->service_id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
