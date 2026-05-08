<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantManagerController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('central.dashboard', compact('tenants'));
    }

    public function create()
    {
        return view('central.create-tenant');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'     => 'required|string|unique:tenants,id|alpha_dash',
            'domain' => 'required|string|unique:domains,domain',
        ]);

        $tenant = Tenant::create(['id' => $request->id]);
        $tenant->domains()->create(['domain' => $request->domain]);

        return redirect()->route('central.dashboard')
            ->with('success', "Tenant {$request->id} created successfully!");
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('central.dashboard')
            ->with('success', "Tenant deleted successfully!");
    }
}