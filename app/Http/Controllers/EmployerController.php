<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::query()
                             ->with('jobs')
                             ->get();

        return view('components.employers', [
            'employers' => $employers
        ]);
    }

    public function dashboard()
    {
        $employer = Auth::user()->employer;
        $jobs     = $employer->jobs()->latest()->with('tags')->get();

        $stats = [
            'total_jobs'    => $jobs->count(),
            'featured_jobs' => $jobs->where('featured', true)->count(),
            'active_jobs'   => $jobs->count(), // You can add status field later
        ];

        return view('dashboard.index', [
            'employer' => $employer,
            'jobs'     => $jobs,
            'stats'    => $stats,
        ]);
    }

    public function profile()
    {
        $employer = Auth::user()->employer;

        return view('dashboard.profile', [
            'employer' => $employer,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $employer = Auth::user()->employer;

        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($employer->logo && Storage::disk('public')->exists($employer->logo)) {
                Storage::disk('public')->delete($employer->logo);
            }

            $logoPath           = $request->logo->store('logos', 'public');
            $attributes['logo'] = $logoPath;
        }

        $employer->update($attributes);

        return redirect('/dashboard/profile')->with('success', 'Profile updated successfully!');
    }
}
