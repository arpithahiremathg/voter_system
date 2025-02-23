@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Dashboard</h2>

        <div class="row">
            <!-- Users Tile -->
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Voters</h5>
                        <p class="card-text display-4">{{ $total_voters }}</p>
                    </div>
                </div>
            </div>


            <!-- Voters Tile -->
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Today Registered Voters</h5>
                        <p class="card-text display-4">{{ $today_register_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
