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
        color: #000;
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

    /* Style for modal popup */
   .modal {
    border-radius: 5px;
    border: solid 2px gray;
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
        border-radius: 10px;
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
        .modal-content button:hover{
        background-color: royalblue;
        color: white;
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
    .expiry{
        margin-top: 5px;
        padding: 5px 20px;
        text-decoration: none;
        border: solid 2px gray;
        border-radius: 5px;
        color: rgb(252, 252, 252);
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        white-space: nowrap;

        background: red;
    }
    .applied{
        margin-top: 5px;
        padding: 5px 20px;
        text-decoration: none;
        border: solid 2px gray;
        border-radius: 5px;
        color: rgb(252, 252, 252);
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        white-space: nowrap;
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
    .input-group {
            width: ;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .input-box {
            margin-right: 40px;
            width: 50%;
        }

        .input-box.full-width {
            width: 100%;
        }

        .input-box label {
            display: block;
            margin-bottom: 5px;
        }

        .input-box input[type="text"],
        .input-box input[type="date"],
        .input-box input[type="number"],
        .input-box input[type="tel"],
        .input-box input[type="file"],
        .input-box textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .input-box .select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

</style>

@section('employer')
@if(Auth::user()->role == 2)
    <h1>My Jobs</h1>
@else
    <h1>All Jobs</h1>
@endif
    <div class="table-head">
        <h2>Job Title</h2>
        <h2>Category</h2>
        <h2>Deadline</h2>
        <h2>Status</h2>
        {{-- <h2>Published Date</h2> --}}
        <h2>Applicants</h2>
        <h2>Action</h2>
    </div>
    @foreach($jobs as $job)
    @php
            $isExpired = $job->deadline->isPast();
            $userRole = Auth::user()->role;
        @endphp
        
        {{-- If user role is 1 and job is expired, skip this iteration --}}
        @if($userRole == 1 && $isExpired)
            @continue
        @endif
    <div class="list">
        <div class="job-details">
            <h2 class="detail">{{ $job->title }}</h2>
            <h5 class="detail">{{ $job->category->title }}</h5>
            <h5 class="detail">{{ $job->deadline->format('jS M Y') }}</h5>
            @if($job->deadline->isPast())
                <h5 class="detail" style="color: red;">Expired</h5>
            @else
                <h5 class="detail" style="color: green;">Active</h5>
            @endif
            {{-- <h5 class="detail">{{ $job->created_at->format('jS M Y') }}</h5> --}}
            <h5 class="detail">{{ $job->position }} Position</h5>
        </div>
        <div class="btn">
            <button class="button"><a href="{{ route('job', ['id' => $job->id]) }}" >View more</a></button>
            {{-- <a href="#">View more</a> --}}
            @if(Auth::check() && Auth::user()->role == 2)
            <button class="button">Edit</button>
            {{-- <button class="button" onclick="openEditForm('{{ $job->id }}')">Edit</button> --}}

            {{-- <button class="button">Edit</button> --}}
                {{-- <a href="#">Edit</a> --}}
                <form class="" action="{{ route('delete_job', ['id' => $job->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                <button onclick="confirmDelete('{{ route('delete_job', ['id' => $job->id]) }}')" class="button">Delete</button>
            </form>                    
                <!-- Modified the Delete button to include a confirmation dialog -->
                {{-- <button onclick="confirmDelete('{{ route('delete_job', ['id' => $job->id]) }}')" class="delete-btn">Delete</button> --}}
            @else
                @if($job->deadline->isPast())
                    <button class="expiry" disabled>Expired</button>
            @else
                @if($job->applications()->where('user_id', Auth::user()->id)->exists()) <br><br>
                <span class="applied">Applied</span>
            @else
                <button class="button" onclick="showApplyForm('{{ $job->id }}')">Apply</button>
            @endif
                    {{-- <button class="button"  onclick="showApplyForm('{{ $job->id }}')">Apply</button> --}}
                @endif
            @endif
        </div>
    </div>
@endforeach

<!-- Edit Job Popup -->
<div id="editJobPopup" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditForm()">&times;</span>
        <h1>Edit Job</h1>
        <form id="editJobForm" method="POST" action="{{ route('update_job', ['id' => $job->id]) }}">
            @csrf
            @method('PATCH')
            <div class="input-group">
                <div class="input-box">
                    <label>Category:</label>
                    <select class="select" name="category_id" required>
                        <option value="0">None</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $job->category_id) ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-box">
                    <label>Job Title:</label>
                    <input type="text" name="title" required value="{{ old('title', $job->title) }}">
                    @error('title')
                    <div class="red">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="input-group">
                <div class="input-box">
                    <label>Type:</label>
                    <input type="text" name="type" required value="{{ old('type', $job->type) }}">
                    @error('type')
                    <div class="red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <label>Salary:</label>
                    <input type="number" name="salary" required value="{{ old('salary', $job->salary) }}">
                    @error('salary')
                    <div class="red">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="input-group">
                <div class="input-box">
                    <label>Deadline:</label>
                    <input type="date" name="deadline" id="deadline" required value="{{ old('deadline', $job->deadline) }}">
                    <span id="deadlineError" class="red hidden">Deadline should be at least two days ahead of today.</span>
                    @error('deadline')
                    <div class="red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <label>Vacancy:</label>
                    <input type="number" name="position" required value="{{ old('position', $job->position) }}">
                    @error('position')
                    <div class="red">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="input-box">
                <label>Description:</label>
                <textarea id="description" name="description" class="custom-textarea" rows="5" required>{{ old('description', $job->description) }}</textarea>
                @error('description')
                <div class="red">{{ $message }}</div>
                @enderror
            </div>

            <!-- Add other fields for editing -->
            <button class="submit" type="submit">Save</button>
        </form>
    </div>
</div>


<!-- JavaScript -->
<script>
    // Function to open edit form popup
    function openEditForm(jobId) {
        // Display the edit form popup
        document.getElementById('editJobPopup').style.display = 'block';
    }

    // Function to close edit form popup
    function closeEditForm() {
        document.getElementById('editJobPopup').style.display = 'none';
    }

    // Deadline validation
    document.getElementById("deadline").addEventListener("change", function() {
        var selectedDate = new Date(this.value);
        var today = new Date();
        var twoDaysLater = new Date();
        twoDaysLater.setDate(today.getDate() + 2);

        if (selectedDate < twoDaysLater) {
            document.getElementById("deadlineError").classList.remove("hidden");
        } else {
            document.getElementById("deadlineError").classList.add("hidden");
        }
    });
</script>



    <!-- Modal Popup -->
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

    <!-- JavaScript function to handle confirmation dialog -->
    <script>
        function confirmDelete(url) {
            if (confirm('Are you sure you want to delete this job?')) {
                window.location.href = url;
            }
        }

        function showApplyForm(jobId) {
            document.getElementById('job_id').value = jobId;
            document.getElementById('applyModal').style.display = 'block';
        }

        function closeApplyForm() {
            document.getElementById('applyModal').style.display = 'none';
        }
    </script>
    
@endsection