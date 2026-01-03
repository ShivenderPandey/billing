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
            ->orderBy('expiry_date')
            ->paginate(20);

        return view('admin.websites.index', compact('websites'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.websites.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
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

        Website::create($data);

        return redirect()
            ->route('admin.websites.index')
            ->with('success', 'Website created.');
    }
}
