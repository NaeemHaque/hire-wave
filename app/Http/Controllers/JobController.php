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
            'description' => ['nullable', 'string'],
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

        // Get similar jobs based on tags and other criteria
        $similarJobs = Job::query()
            ->where('id', '!=', $job->id) // Exclude current job
            ->whereHas('tags', function ($query) use ($job) {
                $query->whereIn('name', $job->tags->pluck('name'));
            })
            ->orWhere('schedule', $job->schedule)
            ->orWhere('location', 'like', '%' . $job->location . '%')
            ->with(['employer', 'tags'])
            ->latest()
            ->limit(3)
            ->get();

        // If not enough similar jobs, get recent jobs
        if ($similarJobs->count() < 3) {
            $additionalJobs = Job::query()
                ->where('id', '!=', $job->id)
                ->whereNotIn('id', $similarJobs->pluck('id'))
                ->with(['employer', 'tags'])
                ->latest()
                ->limit(3 - $similarJobs->count())
                ->get();

            $similarJobs = $similarJobs->merge($additionalJobs);
        }

        return view('jobs.show', [
            'job' => $job,
            'similarJobs' => $similarJobs,
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
            'description' => ['nullable', 'string'],
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
