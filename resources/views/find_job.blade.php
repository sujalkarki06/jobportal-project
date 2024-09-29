<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        height: auto;
    }

    .btn {
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

    .btn:hover {
        color: white;
        background: royalblue;
    }

    .modal-content h1 {
        text-align: center;
    }

    .input-box input[type="file"],
    .input-box textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 10px;
    }

    h1 {
        text-align: center;
    }

    .job-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-left: 10px;
        margin-right: 10px;
    }

    .job-box {
        width: calc(25% - 20px);
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    .search-container {
        text-align: center;
        padding: 10px;
        margin: 0;
    }

    .search-form {
        display: inline-block;
        width: 95%;
        border: 2px solid #ccc;
        border-radius: 10px;
        margin: 0;
    }

    .input {
        display: inline-block;
        margin-right: 10px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        margin-top: 5px;
        font-size: 18px;
    }

    select,
    input[type="text"] {
        width: 600px;
        padding: 10px;
        font-size: 16px;
        border: 2px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    button.search-btn {
        padding: 10px 20px;
        font-size: 18px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button.search-btn:hover {
        background-color: #0056b3;
    }

    .pagination {
        text-align: center;
    }

    .arrow {
        color: royalblue;
        text-decoration: none;
    }

    .arrow {
        color: royalblue;
        text-decoration: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
    }

    .arrow.visible {
        display: block;
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
</style>

@include('partials.header')
<a href="javascript:history.go(-1)" class="arrow">← back</a>
<h1>Jobs List</h1>

<div class="search-container">
    <form action="{{ route('find_job') }}" method="get" class="search-form">
        <div class="input">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="0">None</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
            <label for="search">Search Jobs:</label>
            <input type="text" name="search" id="search">
        </div>
        <button type="submit" class="search-btn">Go!</button>
    </form>
</div>

@php $jobCounter = 0; @endphp
<div class="job-container">
    @foreach($jobs as $job)
    
    <div class="job-box @if($job->deadline->isPast()) expired-job @endif">
        <h2>{{ $job->title }}</h2>
        <div>Category: {{ $job->category->title }}</div>
        <div>Apply before: {{ $job->deadline->format('jS M Y') }}</div>
        <div>Company Name: {{ $job->user->company->name }}</div><br>
        <div class="button">
            <a href="{{ route('job', $job->id) }}" class="btn">View more</a>
            @if(Auth::check() && $job->user_id == Auth::user()->id)
                @if(Auth::user()->role == 2)
                    {{-- <a href="javascript:void(0)" class="btn" onclick="openEditForm('{{ $job->id }}')">Edit</a> --}}
                    <a href="" class="btn">Edit</a>
                    <a href="javascript:void(0)" onclick="confirmDelete('{{ route('delete_job', $job->id) }}')" class="btn">Delete</a>
                @endif
            @elseif(Auth::check() && Auth::user()->role == 1)
                @if($job->applications()->where('user_id', Auth::user()->id)->exists())
                    <span class="btn">Applied</span>
                @elseif($job->deadline->isPast())
                    <span class="btn">Expired</span>
                @elseif(!$job->applications()->where('user_id', Auth::user()->id)->exists())
                    <a href="javascript:void(0)" class="btn" onclick="showApplyForm('{{ $job->id }}')">Apply</a>
                @endif
            @endif
        </div>
        
        
    </div>
    @php
        $jobCounter++;
        if ($jobCounter % 4 === 0 && $jobCounter !== count($jobs)) {
            echo '</div><div class="job-container">';
        }
    @endphp
    @endforeach
</div>

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

<div class="pagination">
    @include('custom-pagination', ['paginator' => $jobs])
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
                    <input type="text" name="title" required value="{{ old('title', $job->title ?? '') }}">
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
