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
public function edit(Website $website)
    {
        $users = User::where('role', 'user')->get();
        return view('admin.websites.edit', compact('website', 'users'));
    }
    
    public function update(Request $request, Website $website)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:websites,domain,' . $website->id,
            'billing_amount' => 'required|numeric',
            'billing_currency' => 'required|string|size:3',
            'billing_frequency' => 'required|in:monthly,yearly',
            'expiry_date' => 'required|date',
            'status' => 'required|in:active,expired',
            'notes' => 'nullable|string',
        ]);
    
        $website->update($request->all());
    
        return redirect()->route('admin.websites.index')
            ->with('success', 'Website updated');
    }
    
    public function destroy(Website $website)
    {
        $website->delete();
        return back()->with('success', 'Website deleted');
    }
    

}
