<style>
    h1 {
        flex: 1;
        text-align: center;
        margin: 0;    
    }

    .list {
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    .table-head {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        margin-bottom: 10px; /* Add margin-bottom to create gap between table head and job details */
    }

    .table-head h2 {
        flex: 1;
        text-align: center;
        margin: 0;
    }
    .job-details h5{
        flex: 1;
        text-align: center;
        margin: 0;
    }

    .job-details {
        width: 100%;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        /* margin-left: 50px; */
    }

    .job-details .detail {
        flex: 1;
        margin-bottom: 10px;
        padding: 5px;
        text-align: center;
    }

    .job-details h2 {
        margin: 0;
        text-align: center;
    }
</style>

@extends('layouts.userlayout')

@section('employer')
    <h1>Applied Jobs</h1>
    <div class="table-head">
        <h2>Job Title</h2>
        <h2>Category</h2>
        <h2>Company Name</h2>
        <h2>Applied Date</h2>
    </div>
    @if($applications->isEmpty())
        <p>No jobs applied yet.</p>
    @else
        @foreach($applications as $application)
            <div class="list">
                <div class="job-details">
                    <h2 class="detail">{{ $application->job->title }}</h2>
                    <h5 class="detail">{{ $application->job->category->title }}</h5>
                    <h5 class="detail">{{ $application->job->user->company->name }}</h5>
                    <h5 class="detail">{{ $application->created_at->format('jS M Y') }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endsection
