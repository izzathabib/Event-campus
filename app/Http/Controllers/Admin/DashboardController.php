<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboardView()
    {
        // Get all society users with role relationship
        $societies = User::whereHas('roles', function($query) {
            $query->where('desc', 'society');
        })->get();

        return view('admin.dashboard', compact('societies')); 
    }

    public function verifyUser($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's verification status
        $user->admin_verified = true;
        $user->save();

        return redirect()->back()->with('userVerified', 'User verified successfully.');
    }
}