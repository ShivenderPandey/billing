<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Website;

class WebsiteController extends Controller
{
     public function index()
    {
        $websites = Website::with('user')
            ->latest()
            ->get();
            
        return view('admin.websites.index', compact('websites'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.websites.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,id',
            'name'              => 'required|string|max:255',
            'domain'            => 'required|string|max:255|unique:websites,domain',
            'billing_amount'    => 'nullable|numeric',
            'billing_currency'  => 'nullable|string|max:10',
            'billing_frequency' => 'required|string',
            'expiry_date'       => 'required|date',
            'status'            => 'required|string',
            'notes'             => 'nullable|string',
        ]);

        Website::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'domain' => $request->domain,
            'billing_amount' => $request->billing_amount,
            'billing_currency' => strtoupper($request->billing_currency),
            'billing_frequency' => $request->billing_frequency,
            'expiry_date' => $request->expiry_date,
            'status' => 'active',
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('admin.websites.index')
            ->with('success', 'Website created.');
    }
}
