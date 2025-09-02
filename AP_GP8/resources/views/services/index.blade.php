@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Services</h2>
        <a class="btn btn-success" href="{{ route('services.create') }}">Create New Service</a>
    </div>

    <form method="GET" action="{{ route('services.index') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="facility_id" value="{{ request('facility_id') }}" class="form-control" placeholder="Filter by Facility ID">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach (\App\Models\Service::CATEGORIES as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service ID</th>
                <th>Name</th>
                <th>Facility ID</th>
                <th>Category</th>
                <th>Skill Type</th>
                <th>Description</th>
                <th width="180px">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($services as $service)
            <tr>
                <td>{{ $service->service_id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->facility_id }}</td>
                <td>{{ $service->category }}</td>
                <td>{{ $service->skill_type }}</td>
                <td>{{ Str::limit($service->description, 80) }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('services.edit', $service->service_id) }}">Edit</a>
                    <form action="{{ route('services.destroy', $service->service_id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this service?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">No services found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
