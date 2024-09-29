<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        
        .header {
            border-bottom: solid 2px royalblue;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        
        .logo {
            /* margin-top: 15px; */
            height: 75px;
            display: inline;
            margin-right: 10px;
        }
        
        .header ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        .header li {
            margin: 0 5px;
            cursor: pointer;
            border: 2px solid royalblue;
            display: inline-block;
            border-radius: 10px;
            position: relative; /* Added */
        }
        
        .header a {
            color: #4169E1 ;
            display: block;
            text-decoration:none;
            font-weight:bolder;
            position: relative;
            z-index: 1;
            padding: 5px 10px;
        }
        
        .header a:hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: royalblue;
            z-index: -1;
            border-radius: 5px;
        }

        .header a:hover {
            color: white;
        }

        /* Added styles for dropdown */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="/images/findone.png" alt="" class="logo">

        <div class="head">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('find_job') }}">Find Jobs</a></li>
                @guest <!-- Check if user is a guest (not logged in) -->
                    <li id="login" class="active"><a href="{{ route('login') }}" class="active">Login</a></li>
                    <li id="register" class="active"><a href="{{ route('register') }}" class="active">Register</a></li>
                @else <!-- User is logged in -->
                    <li class="dropdown">
                        <a href="#" class="dropbtn">{{ Auth::user()->name }}</a>
                        <div class="dropdown-content">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Log Out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                    </form>
                            </div>
                            <!-- <a href="{{ route('logout') }}">Logout</a> -->
                            <!-- Add other dropdown options if needed -->
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</body>
</html>
