@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Facilities Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('facilities.create') }}"> Create New Facility</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class = "table table-bordered">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Location</th>
            <th>Facility Type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($facilities as $facility)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $facility->name }}</td>
            <td>{{ $facility->location }}</td>
            <td>{{ $facility->facility_type }}</td>
            <td>
                <form action="{{ route('facilities.destroy',$facility->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('facilities.show', $facility->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('facilities.edit', $facility->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection