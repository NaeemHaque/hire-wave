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
        //eager loading
        $jobs = Job::query()
                   ->latest()
                   ->with(['employer', 'tags'])
                   ->get()
                   ->groupBy('featured');

        $tags = Tag::query()
                   ->distinct('name')
                   ->get();

        return view('jobs.index', [
            'featuredJobs' => $jobs[1] ?? [],
            'jobs'         => $jobs[0] ?? [],
            'tags'         => $tags,
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

        return redirect('/dashboard')->with('success', 'Job created!');
    }

    public function show(Job $job)
    {
        $job->load(['employer', 'tags']);

        return view('jobs.show', [
            'job' => $job,
        ]);
    }

    public function edit(Job $job)
    {
        // Ensure the authenticated user owns this job
        if ($job->employer->user_id !== Auth::id()) {
            abort(403);
        }

        $job->load('tags');

        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        // Ensure the authenticated user owns this job
        if ($job->employer->user_id !== Auth::id()) {
            abort(403);
        }

        $attributes = $request->validate([
            'title'    => ['required'],
            'salary'   => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Full Time', 'Part Time', 'Contract'])],
            'url'      => ['required', 'active_url'],
            'tags'     => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job->update(Arr::except($attributes, 'tags'));

        // Update tags
        $job->tags()->detach();
        if ($attributes['tags']) {
            $tags = explode(',', $attributes['tags']);
            foreach ($tags as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/dashboard')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        // Ensure the authenticated user owns this job
        if ($job->employer->user_id !== Auth::id()) {
            abort(403);
        }

        $job->delete();

        return redirect('/dashboard')->with('success', 'Job deleted successfully!');
    }
}
