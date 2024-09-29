<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout of dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .profile img{
            width: 15%;
            height: auto;
        }
        .container{
            flex-shrink: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: row;
            
        }
         .link {
            background-color: #f2f2f2;
            padding: 20px;
            width: 20%;
            flex-shrink: 0; /* Prevent shrinking */
            /* flex-direction: column; Changed to column */
        }
        .content {
            padding: 20px;
            overflow: hidden;
            flex-grow: 1;
            border: solid 2px #EFEEEE;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow effect */
            margin: 10px; /* Add margin for gap between container and content */
        }
        .link a {
            display: block;
            margin-bottom: 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            /* color: black; Default color */
            text-decoration: none;
            margin-right: 10px;
        }
        .link a:hover{
            color: royalblue;
        }
        .link a.active {
            color: royalblue; /* Color when active */
        }
    </style>
</head>
<body>
    @include('partials.header')
    <div class="container">
    <div class="link"><br><br>
        {{-- <a href="{{ route('dashboard') }}"  onclick="changeColor(this, 'dashboard')">Dashboard</a><br><br> --}}
        @if(Auth::user()->role == 2)
        @if(Auth::user()->company)
    <a href="{{ route('company.edit') }}" onclick="changeColor(this, 'profile')">Update Profile</a><br><br>
@else
    <a href="{{ route('company_registration') }}" onclick="changeColor(this, 'update-profile')"> Profile</a><br><br>
@endif
            <a href="{{ route('add_job_form') }}" onclick="changeColor(this, 'post-job')">Post a Job</a><br><br>
            <a href="{{ route('applications', ['id' => Auth::id()]) }}" onclick="changeColor(this, 'application')">Application</a><br><br>
        @else
            <a href="{{ route('profile_edit') }}" onclick="changeColor(this, 'apply-job')">Profile</a><br><br>
            <a href="{{ route('applied_job') }}" onclick="changeColor(this, 'apply-job')">Applied Job</a><br><br>
        @endif
        <a href="{{ route('jobs') }}" onclick="changeColor(this, 'all-job')">All Job</a><br><br>
        <a href="{{ route('profile.edit') }}" onclick="changeColor(this, 'setting')">Setting</a><br><br>
        <a href="{{ route('logout') }}"
    onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
    {{ __('Log Out') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
            </form>
    </div>

    <div class="content">
        @yield('employer')
    </div>
</div>

    @include('partials.footer')

    <script>
        // Function to set active link and store it in local storage
        function setActiveLink() {
            var currentPath = window.location.pathname;
            var links = document.querySelectorAll('.link a');
            links.forEach(function(link) {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    localStorage.setItem('activeLink', currentPath); // Store active link in local storage
                }
            });
        }
    
        // Function to handle link clicks
        function changeColor(element, section) {
            var links = document.querySelectorAll('.link a');
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            
            element.classList.add('active');
            localStorage.setItem('activeLink', element.getAttribute('href')); // Store active link in local storage
            console.log(section);
        }
    
        // Call setActiveLink function when the page loads
        window.addEventListener('load', setActiveLink);
    
        // Check local storage for active link on page reload
        var storedLink = localStorage.getItem('activeLink');
        if (storedLink) {
            var links = document.querySelectorAll('.link a');
            links.forEach(function(link) {
                if (link.getAttribute('href') === storedLink) {
                    link.classList.add('active');
                }
            });
        }
        
    </script>
    
</body>
</html>
