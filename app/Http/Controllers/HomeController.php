<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve all categories
        $categories = Category::all();
        $company = Company::all();
 
        // Retrieve all jobs
        $jobs = Job::all();

        // Pass categories and jobs to the homepage view
        return view('home', compact('categories', 'jobs','company'));
    }
}
