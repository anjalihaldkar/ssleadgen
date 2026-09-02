<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Client;
use App\Models\Lead;
use App\Models\LeadSource;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('leadSource')->latest()->get();
        $leadsByStatus = $leads->groupBy('status');

        return view('pages.crm.pipeline', compact('leads', 'leadsByStatus'));
    }

    public function create()
    {
        $leadSources = LeadSource::where('is_active', true)->get();

        return view('pages.crm.create', compact('leadSources'));
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->validated());

        return redirect()->route('crm.pipeline')->with('success', 'Lead created successfully.');
    }

    public function convert(Request $request, Lead $lead)
    {
        // Change lead status to won
        $lead->update(['status' => 'won']);

        // Create a new client record
        $client = Client::create([
            'first_name' => $lead->first_name,
            'last_name' => $lead->last_name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'lead_source_id' => $lead->lead_source_id,
            'user_id' => $lead->user_id,
            'notes' => $lead->notes,
            'status' => 'Inforce',
        ]);

        return redirect()->route('clients.index')->with('success', 'Lead successfully converted to Client!');
    }
}
