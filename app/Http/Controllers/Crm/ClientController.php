<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    public function index($status = null)
    {
        $query = Client::with(['leadSource', 'policies']);

        if ($status) {
            // Map the route parameter to the actual enum value
            $statusMap = [
                'inforce' => 'Inforce',
                'inactive' => 'Inactive',
                'cancellation' => 'Cancellation',
                'npw-deferred' => 'NPW Deferred',
            ];

            if (array_key_exists($status, $statusMap)) {
                $query->where('status', $statusMap[$status]);
            }
        }

        $clients = $query->latest()->get();

        return view('pages.clients.index', compact('clients', 'status'));
    }
}
