<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get()->groupBy('featured');

        return view('jobs.index', [
            'featuredJobs' => $jobs[0],
            'jobs'         => $jobs[1],
            'tags'         => Tag::all(),
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title'    => ['required'],
            'salary'   => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Full Time', 'Part Time', 'Contract'])],
            'url'      => ['required', 'active_url'],
            'tags'     => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags']) {
            $tags = explode(',', $attributes['tags']);

            foreach ($tags as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/')->with('success', 'Job created!');
    }
}
