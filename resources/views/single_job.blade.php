<style>
    h2{
        text-align: center;
    }
    .detail-container {
        display: flex;
        padding: 20px;
    }

    .left {
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        flex: 1;
        /* padding-right: 20px; */

        padding: 20px;
        margin-bottom: 20px;
    }

    .right {
        flex: 1;
        padding-left: 20px;
    }

    /* Style for job detail box */
    .job-detail-box {
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        padding: 20px;
        margin-bottom: 20px; /* Add margin to create gap between job detail box and footer */
    }

    /* Additional styling for buttons if needed */
    .btn {
        margin-right: 20px;
        margin-bottom: 20px;
    text-align: right;
    margin-top: 10px; /* Adjust as needed */
}

.btn a {
    padding: 10px 20px;
    text-decoration: none;
    border: 2px solid royalblue;
    border-radius: 5px;
    color: royalblue;
    transition: background-color 0.3s, color 0.3s;
}

.btn a:hover {
    background-color: royalblue;
    color: white;
}

    /* Style for modal popup */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 40%; /* Could be more or less, depending on screen size */
        height: auto;
    }
    .modal-content h1{
        text-align: center;
    }
        .modal-content button{
            width: 15%;
            height: 45px;
            background: #fff;
            /* background: royalblue; */
            border: solid 1px #9C9B9B;
            outline: none;
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;

            margin: auto;
            display: block;
        }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .expiry,
    .button{
        margin-top: 5px;
        padding: 5px 20px;
        text-decoration: none;
        border: solid 2px royalblue;
        border-radius: 5px;
        color: royalblue;
        width: 6%;
        height: 5.5%;
        box-sizing: border-box;
        text-align: center;
        white-space: nowrap;

    }
    .button:hover{
        color: white;
        background: royalblue;
    }
    .input-box input[type="file"],
    .input-box textarea{
        width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
    }
    .apply{
        border: solid 2px royalblue;
        border-radius: 5px;
        margin-top: 5px;
        padding: 5px 20px;
        text-decoration: none;
        width: 6%;
        
    }
</style>

@include('partials.header')

{{-- @extends('layouts.userlayout') --}}

{{-- @section('employer') --}}
<h2>Detail Job</h2>
<div class="detail-container">
    <div class="left">
            <div class="job_detail">
                <h2>{{ $job->title }}</h2>
                <h4>Job Description</h4>
                <div>{{ $job->description }}</div><br>
            </div>
    </div>
    <div class="right">
        <div class="job-detail-box">
            <div class="summary">
                <h3>Job Summary</h3>
                <label>Job Type: {{ $job->type }}</label><br>
                {{-- <label>Published on: {{ $job->created_at->format('jS M Y') }} </label><br> --}}
                <label>Salary: {{ $job->salary }}</label><br>
                <label>Vacancy: {{ $job->position }}</label><br>
                <label>Deadline: {{ $job->deadline->format('jS M Y') }} </label>
            </div>
        </div>
        <div class="job-detail-box">
            <div class="company">
                <h3>Company Detail</h3>
                @if ($job->user->company)
                    <label>Company Name: {{ $job->user->company->name }}</label><br>
                    <label>Location: {{ $job->user->company->address }}</label><br>
                    <label>Contact: {{ $job->user->company->phone }}</label><br>
                    <label>Web: {{ $job->user->company->URL }}</label><br>
                @else
                    <p>No company details available</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="btn">
    @if(Auth::check() && Auth::user()->role == 1)
        @if($job->deadline->isPast())
            <span class="expiry" disabled>Expired</span>
        @else
            @if($job->applications()->where('user_id', Auth::user()->id)->exists())
                <span class="button">Applied</span>
            @else
                <button class="apply" onclick="showApplyForm('{{ $job->id }}')">Apply</button>
            @endif
        @endif
    @endif
    <a href="javascript:history.go(-1)">Back</a>
</div>


@include('partials.footer')


<div id="applyModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeApplyForm()">&times;</span>
        <h1>Apply job</h1>
        <form id="applyForm" method="POST" action="{{ route('apply_job_form') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="job_id" name="job_id" value="">
        <div class="input-box">
            <label>Cover Letter:</label>
            <textarea name="cover_letter"></textarea><br>
        </div>
        <div class="input-box">
            <label>Resume</label>
            <input type="file" name="attachment"><br>
        </div>
            <button class="submit" type="submit">Apply</button>
        </form>
    </div>
</div>

<script>
    function showApplyForm(jobId) {
        document.getElementById('job_id').value = jobId;
        document.getElementById('applyModal').style.display = 'block';
    }

    function closeApplyForm() {
        document.getElementById('applyModal').style.display = 'none';
    }
</script>