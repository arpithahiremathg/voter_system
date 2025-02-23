<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'total_voters' => Voter::count(),
            'today_register_count' => Voter::whereDate('created_at', today())->count(),
        ]);
    }
}
