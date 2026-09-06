<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($status = null)
    {
        $query = Client::with(['leadSource', 'policies']);

        if ($status) {
            $statusMap = [
                'inforce'      => 'Inforce',
                'inactive'     => 'Inactive',
                'cancellation' => 'Cancellation',
                'npw-deferred' => 'NPW Deferred',
                'claims'       => 'Claims',
            ];

            if (array_key_exists($status, $statusMap)) {
                $query->where('status', $statusMap[$status]);
            }
        }

        $clients = $query->latest()->get();

        $viewName = $status ? "pages.clients.{$status}" : 'pages.clients.index';

        if (view()->exists($viewName)) {
            return view($viewName, compact('clients', 'status'));
        }

        return view('pages.clients.index', compact('clients', 'status'));
    }

    public function loginClients()
    {
        $loginClients = Client::loginClients()->latest()->get();
        // The users table doesn't have 'is_active' column. 
        // We'll fetch all users or filter by 'status' if applicable. Let's just fetch all names for now.
        $advisers = User::orderBy('name')->pluck('name');

        return view('pages.auth.clients-login', compact('loginClients', 'advisers'));
    }

    public function storeLoginClient(Request $request)
    {
        $data = $request->validate([
            'policy_no'         => 'nullable|string|max:50',
            'company'           => 'required|string|max:100',
            'login_date'        => 'nullable|date',
            'anp'               => 'nullable|numeric',
            'first_name'        => 'required|string|max:100',
            'last_name'         => 'required|string|max:100',
            'dob'               => 'nullable|date',
            'phone'             => 'required|string|max:30',
            'email'             => 'nullable|email|max:150',
            'address'           => 'nullable|string|max:200',
            'suburb'            => 'nullable|string|max:100',
            'city'              => 'nullable|string|max:100',
            'post_code'         => 'nullable|string|max:20',
            'adviser'           => 'nullable|string|max:100',
            'not_counting'      => 'nullable|boolean',
            'compliance_by'     => 'nullable|string|max:100',
            'roa_due_date'      => 'nullable|date',
            'status_compliance' => 'nullable|string|max:50',
            'sent_to_client'    => 'nullable|string|max:20',
            'outcome'           => 'nullable|string|max:300',
        ]);

        $data['status']       = 'Login Client';
        $data['not_counting'] = $request->boolean('not_counting');

        Client::create($data);

        return redirect()->route('clients.login')->with('success', 'Login client added successfully.');
    }

    public function updateLoginClient(Request $request, Client $client)
    {
        $data = $request->validate([
            'policy_no'         => 'nullable|string|max:50',
            'company'           => 'required|string|max:100',
            'login_date'        => 'nullable|date',
            'anp'               => 'nullable|numeric',
            'first_name'        => 'required|string|max:100',
            'last_name'         => 'required|string|max:100',
            'dob'               => 'nullable|date',
            'phone'             => 'required|string|max:30',
            'email'             => 'nullable|email|max:150',
            'address'           => 'nullable|string|max:200',
            'suburb'            => 'nullable|string|max:100',
            'city'              => 'nullable|string|max:100',
            'post_code'         => 'nullable|string|max:20',
            'adviser'           => 'nullable|string|max:100',
            'not_counting'      => 'nullable|boolean',
            'compliance_by'     => 'nullable|string|max:100',
            'roa_due_date'      => 'nullable|date',
            'status_compliance' => 'nullable|string|max:50',
            'sent_to_client'    => 'nullable|string|max:20',
            'outcome'           => 'nullable|string|max:300',
        ]);

        $data['not_counting'] = $request->boolean('not_counting');
        $client->update($data);

        return redirect()->route('clients.login')->with('success', 'Client updated successfully.');
    }

    public function destroyLoginClient(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.login')->with('success', 'Client deleted.');
    }
}
