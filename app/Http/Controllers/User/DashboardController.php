<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();          // logged-in user
        $websites = $user->websites;       // DB query via relation

        return view('dashboard', compact('websites'));
    }
}
