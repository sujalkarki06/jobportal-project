@extends('layouts.userlayout')

@section('employer')
<style>
   .content-section {
            width: 90%;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            background-color: #ffffff;
        }

        .content-section h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
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

        .content-section .btn {
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
    }
.content-section .btn:hover{
    background-color: royalblue;
    color: white;
}
/* Hide the success message by default */
.hidden {
        display: none;
    }

    /* Style the success message as needed */
    #success-message {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }</style>
<div class="content-section">
    <form  method="POST" action="{{ route('add_job') }}" id="addJobForm" enctype="multipart/form-data">
        @csrf
        <h1>Add a new job</h1>
    
        <div class="input-group">
            <div class="input-box">
            <label>Category:</label>
            <select class="select" name="category_id" required> <!-- Corrected the name attribute -->
                <option value="0">None</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="red">{{ $message }}</div>
            @enderror 
        </div>
        <div class="input-box">
            <label>Job Title:</label>
            <input type="text" name="title" required>
            @error('title')
                <div class="red">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="input-group">
        <div class="input-box" >
            <label>Type:</label>
            <input type="text" name="type" required>
            @error('type')
                <div class="red">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="input-box">
            <label>Salary:</label>
            <input type="number" name="salary" required>
            @error('salary')
                <div class="red">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="input-group">
        <div class="input-box">
            <label>Deadline:</label>
            <input type="date" name="deadline" id="deadline" required>
            <span id="deadlineError" class="red hidden">Deadline should be at least two days ahead of today.</span>
            @error('deadline')
                <div class="red">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="input-box">
            <label>Vacancy:</label>
            <input type="number" name="position" required>
            @error('position')
                <div class="red">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="input-box">
        <label>Description:</label>
        <textarea id="description" name="description" class="custom-textarea" rows="5" required value="{{ old('description') }}"></textarea>
        @error('description')
            <div class="red">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn" id="submitBtn">Submit</button>
</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var submitBtn = document.getElementById('submitBtn');
    var deadlineInput = document.getElementById('deadline');
    var deadlineError = document.getElementById('deadlineError');

    submitBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent form submission

        var today = new Date();
        var minDeadline = new Date();
        minDeadline.setDate(today.getDate() + 2); // Minimum deadline should be 2 days from today

        var selectedDate = new Date(deadlineInput.value);

        // Check if the selected date is at least two days ahead of today
        if (selectedDate < minDeadline) {
            deadlineError.classList.remove('hidden');
        } else {
            deadlineError.classList.add('hidden');
            document.getElementById('addJobForm').submit();
        }
    });
});
</script>
@endsection
