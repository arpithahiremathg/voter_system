@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h2 class="mb-4">Voter List</h2>

        <a href="{{ route('voters.create') }}" class="btn btn-primary mb-3">Register New Voter</a>

        <!-- Filters and Search -->
        <form method="GET" action="{{ route('voters.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="state" class="form-control">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="district" class="form-control">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                {{ $district }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name or Email"
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="{{ route('voters.index') }}" class="btn btn-secondary">Reset</a>
                    <a href="{{ route('voters.export.csv') }}" class="btn btn-info">Export to CSV</a>

                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($voters as $voter)
                        <tr>
                            <td>{{ $voter->id }}</td>
                            <td>{{ $voter->first_name }}</td>
                            <td>{{ $voter->last_name }}</td>
                            <td>{{ $voter->mobile }}</td>
                            <td>{{ $voter->email }}</td>
                            <td>{{ $voter->state }}</td>
                            <td>{{ $voter->district }}</td>
                            <td>
                                <form action="{{ route('voters.destroy', $voter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $voters->links() }}
        </div>
    </div>
@endsection
