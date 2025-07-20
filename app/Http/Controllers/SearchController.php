<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $q = $request->input('q');

        $jobs = Job::where('title', 'like', "%$q%")->get();

        return view('result', [
            'jobs' => $jobs,
        ]);
    }
}
