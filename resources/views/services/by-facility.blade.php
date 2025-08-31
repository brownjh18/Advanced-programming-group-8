@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Services for Facility: {{ $facility->name }}</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('services.create', ['facility_id' => $facility->id]) }}"> Add Service</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Category</th>
            <th>Skill Type</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($facility->services as $service)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $service->name }}</td>
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
        @empty
            <tr>
                <td colspan="5" class="text-center">No services found for this facility.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
