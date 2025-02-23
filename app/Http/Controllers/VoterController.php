<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use Illuminate\Support\Facades\Mail;
use App\Mail\VoterRegistered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class VoterController extends Controller
{

    public function index(Request $request)
    {
        $query = Voter::query();

        // Apply filters if provided
        if ($request->has('state') && $request->state != '') {
            $query->where('state', $request->state);
        }

        if (
            $request->has('district') && $request->district != ''
        ) {
            $query->where('district', $request->district);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        $voters = $query->paginate(10);

        // Get unique states and districts for dropdowns
        $states = Voter::select('state')->distinct()->pluck('state');
        $districts = Voter::select('district')->distinct()->pluck('district');

        return view('voters.index', compact('voters', 'states', 'districts'));
    }


    public function create()
    {
        return view('voters.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date|before:-18 years',
                'mobile' => 'required|unique:voters,mobile',
                'email' => 'required|email|unique:voters,email',
                'address' => 'required',
                'taluk' => 'required',
                'district' => 'required',
                'state' => 'required',
            ]);

            $voter = Voter::create($request->all());

            Mail::to($voter->email)->send(new VoterRegistered($voter));

            return redirect()->route('voters.index')->with('success', 'Voter registered successfully.');
        } catch (\Exception $e) {
            Log::error('Voter registration failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while registering the voter. Please try again.');
        }
    }

    public function show(Voter $voter)
    {
        return view('voters.show', compact('voter'));
    }


    // Delete a voter
    public function destroy(Voter $voter)
    {
        $voter->delete();
        return redirect()->route('voters.index')->with('success', 'Voter deleted successfully.');
    }


    public function exportCsv()
    {
        $fileName = 'voters_list.csv';

        // Fetch all voter data
        $voters = Voter::all();

        // Define CSV headers
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        // Create a callback to generate CSV content
        $callback = function () use ($voters) {
            $file = fopen('php://output', 'w');

            // Add the CSV column headers
            fputcsv($file, ['ID', 'First Name', 'Last Name', 'Mobile', 'Email', 'State', 'District']);

            // Add each voter as a CSV row
            foreach ($voters as $voter) {
                fputcsv($file, [
                    $voter->id,
                    $voter->first_name,
                    $voter->last_name,
                    $voter->mobile,
                    $voter->email,
                    $voter->state,
                    $voter->district
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
