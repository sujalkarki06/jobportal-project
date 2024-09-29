<style>
    .arrow {
        color: royalblue;
        text-decoration: none;
    }
    h1 {
        text-align: center;
    }
    .job, .apply {
        margin-bottom: 10px;
        padding: 20px;
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(15, 14, 14, 0.749);
    }
    .applicant {
        margin-bottom: 20px;
        padding: 10px;
        border: solid 2px #ccc;
        border-radius: 5px;
    }
    .applicant h3 {
        margin-bottom: 5px;
    }
    .apply .resume{
        width: 250px;
        height: auto;
    }
</style>

@extends('layouts.userlayout')

@section('employer')
    <h1>Applicants Details</h1>

    {{-- <div class="job">
        <h2>{{ $job->title }}</h2>
        <p>{{ $job->description }}</p>
    </div> --}}

    <div class="apply">
        <h2>People who applied for this job: {{ $job->title }}</h2>
        @foreach($applications as $application)
            <div class="applicant">
                <h3>Name: {{ $application->user->name }}</h3> <!-- Corrected $application->name -->
            <p>Cover Letter: {{ $application->cover_letter }}</p>
            <p>Email: {{ $application->user->email }}</p>
            {{-- <p>Phone Number: {{ $application->user->phone }}</p> --}}
            <p  > @if(isset($application->attachment))
                <p>Resume:</p>
                <img class="resume" src="{{ asset('uploads/' . $application->attachment) }}" alt="Resume">
            @endif</p>
            </div>
        @endforeach
    </div>

    <a href="javascript:history.go(-1)" class="arrow">← Back</a>
@endsection
