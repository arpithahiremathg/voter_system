@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Register New Voter</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card p-4">
            <form action="{{ route('voters.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label fw-bold">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label fw-bold">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Date of Birth -->
                    <div class="col-md-6 mb-3">
                        <label for="dob" class="form-label fw-bold">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>

                    <!-- Mobile -->
                    <div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label fw-bold">Mobile</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <textarea name="address" class="form-control" rows="2" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <!-- Taluk -->
                    <div class="col-md-6 mb-3">
                        <label for="taluk" class="form-label fw-bold">Taluk</label>
                        <input type="text" name="taluk" class="form-control" required>
                    </div>

                    <!-- District -->
                    <div class="col-md-6 mb-3">
                        <label for="district" class="form-label fw-bold">District</label>
                        <input type="text" name="district" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <!-- State -->
                    <div class="col-md-12 mb-3">
                        <label for="state" class="form-label fw-bold">State</label>
                        <input type="text" name="state" class="form-control" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary px-5">Register Voter</button>
                    <a href="{{ route('voters.index') }}" class="btn btn-secondary px-5">Cancel</a>

                </div>

            </form>
        </div>
    </div>
@endsection
