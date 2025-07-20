<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

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

}
