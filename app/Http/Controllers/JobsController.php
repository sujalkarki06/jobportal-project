<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\AddJobRequest;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function add_job_form()
    {
        $categories = Category::all();
        return view('add_job', ['categories' => $categories]);
    }

    public function add_job(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 2) {
            $category_id = $request->category_id;
            $title = $request->title;
            $type = $request->type;
            $salary = $request->salary; // Retrieve salary from request
            $position = $request->position;
            $deadline = $request->deadline;
            $description = $request->description;
            
            $user_id = Auth::id();
    
            $job = Job::create([
                'user_id' => $user_id,
                'category_id' => $category_id,
                'title' => $title,
                'type' => $type,
                'salary' => $salary, // Pass salary to create method
                'description' => $description,
                'position' => $position,
                'deadline' => $deadline,
            ]);
    
            return redirect()->back()->with('success', 'Job created successfully!');
        } else {
            return redirect('/dashboard')->with('error', 'You are not authorized to add a job!');
        }
        
    }
    public function find_job(Request $request)
{
    $category_id = $request->category;
    $search = $request->search;

    $jobsQuery = Job::query();

    if ($category_id && empty($search)) {
        $jobsQuery->where('category_id', $category_id);
    } elseif (empty($category_id) && $search) {
        $jobsQuery->where('title', 'like', '%' . $search . '%');
    } elseif ($category_id && $search) {
        $jobsQuery->where('category_id', $category_id)
                  ->where('title', 'like', '%' . $search . '%');
    }

    // Retrieve paginated results
    $jobs = $jobsQuery->paginate(8);

    $categories = Category::all();

    return view('find_job', ['jobs' => $jobs, 'categories' => $categories]);
}

    public function job_list(Request $request)
{
    // Get the authenticated user's role
    $userRole = Auth::user()->role;

    // Initialize variable to hold jobs
    $jobs = [];

    // Fetch jobs based on the user's role
    if ($userRole == 1) {
        // If the user is role 1, fetch all jobs posted by users with role 2
        $jobs = Job::whereHas('user', function ($query) {
            $query->where('role', 2);
        })->get();
    } elseif ($userRole == 2) {
        // If the user is role 2, fetch only their own jobs
        $userId = Auth::id();
        $jobs = Job::where('user_id', $userId)->get();
    }

    // Fetch all categories (assuming you need them in the view)
    $categories = Category::all();

    // Pass the filtered jobs and categories to the view
    return view('jobs', ['jobs' => $jobs, 'categories' => $categories]);
}

    public function delete_job($id)
{
    $job = Job::find($id);

    if (!$job) {
        return redirect()->back()->with('error', 'Job not found!');
    }

    // Delete the job
    $job->delete();

    return redirect()->back()->with('success', 'Job deleted successfully!');
}
    public function apply_job($id)
    {
        $job = Job::find($id);

        return view('applied_job', ['job' => $job]);
    }
    public function single_job($id)
    {
        $job = Job::find($id);
        
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found!');
        }
    
        // Retrieve the company associated with the job's user
        $company = $job->user->company;
    
        return view('single_job', ['job' => $job, 'company' => $company]);
    }


    public function apply_job_form(Request $request)
    {
        // dd($request->all());

    $job_id = $request->input('job_id');

    $user_id = Auth::id();

 

    // Check if the user has already applied for this job

    $existingApplication = Application::where('user_id', $user_id)

                                      ->where('job_id', $job_id)

                                      ->first();

 

    if ($existingApplication) {

        // User has already applied for this job

        return redirect()->back()->with('error', 'You have already applied for this job.');

    }

 

    $cover_letter = $request->input('cover_letter');

    $attachment = $request->file('attachment');

 

    $file_name = null;

    if ($request->hasFile('attachment') && $request->file('attachment')->isValid()){

        $attachment = $request->file('attachment');

        $file_name = $attachment->hashName();

        $attachment->move('uploads/',$file_name);

    }

 

    Application::create([

        'user_id' => $user_id,

        'job_id' => $job_id,

        'cover_letter' => $cover_letter,

        'attachment' => $file_name,

    ]);
    
        // Redirect to dashboard with a success message
        return redirect('/dashboard')->with('message', 'Application sent successfully!');
    }
    
    public function applications($id)
    {
        // Get the applications associated with the jobs posted by the employer with the given ID
        $applications = Application::whereHas('job', function($query) use ($id) {
            $query->where('user_id', $id);
        })->with('job')->get()->groupBy('job_id');
    
        // Pass the applications to the view
        return view('application', ['applications' => $applications]);
    }
    
    
    
    
    public function applied_job()
    {
        $jobs = Job::all();
        $user_id = Auth::id();
        $applications = Application::where('user_id', $user_id)->with('job.category')->get();
        return view('applied_job', ['applications' => $applications, 'jobs' => $jobs]);
    }
    
    public function application_detail($id)
    {
        $job = Job::findOrFail($id);
        $job = Job::find($id);
        
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found!');
        }
        $applications = Application::where('job_id', $id)->get(); // Filter applications by job ID
        $userApplied = $applications->contains('user_id', Auth::id()); // Check if the authenticated user has applied
        
        return view('application_detail', compact('job', 'applications', 'userApplied'));
    }
       
    public function edit_job_form($id)
    {
        $job = Job::findOrFail($id);
        
        // Check if the authenticated user is authorized to edit this job
        if (Auth::user()->id !== $job->user_id) {
            return redirect('/dashboard')->with('error', 'You are not authorized to edit this job.');
        }
    
        $categories = Category::all();
        
        return view('edit_job', compact('job', 'categories'));
    }
    
    public function update_job(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        
        // Check if the authenticated user is authorized to update this job
        if (Auth::user()->id !== $job->user_id) {
            return redirect('/dashboard')->with('error', 'You are not authorized to update this job.');
        }
    
        // Validate the request data
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'position' => 'required|integer',
            'deadline' => 'required|date',
            'description' => 'required|string',
        ]);
    
        // Update job details
        $job->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'type' => $request->type,
            'salary' => $request->salary,
            'position' => $request->position,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);
    
        return redirect('/dashboard')->with('success', 'Job updated successfully!');
    }
    



}
