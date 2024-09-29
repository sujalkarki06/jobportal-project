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
    function openEditForm(categoryId) {
        // Display the edit form popup
        document.getElementById('editJobPopup').style.display = 'block';
        
        // Set the category_id field in the form
        document.querySelector('select[name="category_id"]').value = categoryId;
        
        // Trigger change event to update other fields based on the selected category
        document.querySelector('select[name="category_id"]').dispatchEvent(new Event('change'));
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
