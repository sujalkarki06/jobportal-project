
@extends('layouts.userlayout')

<style>
    h1 {
        text-align: center;
    }

    .list {
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    
    .btn .button {
        margin-top: 5px;
        padding: 5px 20px;
        text-decoration: none;
        border: solid 2px gray;
        border-radius: 5px;
        color: rgb(15, 14, 14);
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        white-space: nowrap;
    }

    .btn a{
        text-decoration: none;
        /* color: #000; */
    }
    .btn a:hover {
        background: royalblue;
        color: white;
    }
    .btn .button:hover {
        background: royalblue;
        color: white;
    }

    .table-head {
        display: flex;
        justify-content: space-between;
        padding: 10px;
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

@section('employer')
    <h1> Applied Jobs</h1>
    <div class="table-head">
        <h2>Job Title</h2>
        <h2>Category</h2>
        <h2>Applicants</h2>
        <h2>Status</h2>
        <h2>Action</h2>
    </div>
    @if($applications->isEmpty())
        <p>No jobs applied yet.</p>
    @else
        @foreach($applications as $jobId => $jobApplications)
            @php
                $job = $jobApplications->first()->job;
                $totalApplications = count($jobApplications);
            @endphp
         <div class="list">
            
            <div class="job-details">
                <h2 class="detail">{{ $job->title }}</h2>
            <h5 class="detail">{{ $job->category->title }}</h5>
            <h5 class="detail"> {{ $totalApplications }} Applied</h5>
            {{-- <h5 class="detail">{{ $job->created_at->format('jS M Y') }}</h5> --}}
            @if($job->deadline->isPast())
                <h5 class="detail" style="color: red;">Expired</h5>
            @else
                <h5 class="detail" style="color: green;">Active</h5>
            @endif
        </div> 
            <div class="btn">
                <button class="button"><a href="{{ route('detail', ['id' => $job->id]) }}" >View more</a></button>
            </div>
    </div>
        @endforeach
    @endif


@endsection
{{-- <div>
    Applied Date:
    @foreach($jobApplications as $application)
        {{ $application->created_at->format('jS M Y') }} by {{ $application->user->name }}
    @endforeach
            </div>  --}}