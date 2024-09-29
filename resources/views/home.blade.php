<style type="text/css">

    * {

        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;

    }



    body {

        min-height: 100vh;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Hide horizontal overflow */
        position: relative; /* Set position to relative for overlay */

    }



    .pic-container {

        position: relative;
        width: 100%;

    }



    .background {

        width: 100%;
        height: 80%;

    }



    .overlay {

        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(99, 95, 95, 0.5); /* Semi-transparent white background */
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px 20px 100px 20px; /* Adjust padding as needed */

    }



    .content {

        font-size: 20px;
        color: rgb(244, 244, 244); /* Text color */
        margin-top: 80px;

    }



    .search-bar {

        position: absolute;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border-radius: 10px;

    }



    .search-bar input[type="text"] {

        width: 400px;
        padding: 15px;
        border: none;
        border-radius: 30px;
        outline: none;
        font-size: 18px;

    }



    .search-bar button {

        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        font-size: 18px;

    }



    .category-boxes {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;

    }



    .category-box {

        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        text-align: center;

        /* background-color: #f0f0f0; */

        padding: 20px;

        border-radius: 10px;

        width: calc(50% - 20px); /* Adjust width to fit two boxes in a row with gap */

    }



    .job-boxes {

        display: flex;

        flex-wrap: wrap;

        gap: 20px;

    }



    .job-box {

        /* text-align: center; */
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        background-color: #f0f0f0;

        padding: 20px;

        border-radius: 10px;

        width: calc(50% - 20px); /* Adjust width to fit two boxes in a row with gap */

    }


    .title{
        text-align: center;
    }



    .home-page {

        padding: 20px;

    }



    .category {

        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        padding: 20px;

        /* border: solid 2px gray; */

        flex: 1; /* Take up half of the space */

        padding-right: 20px; /* Add some spacing between categories and jobs */

    }

    .category h2{

        text-align: center;

    }



    .jobs {

        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        /* border: solid 2px gray; */

        flex: 1; /* Take up half of the space */

        padding-left: 20px; /* Add some spacing between categories and jobs */

    }

    .jobs h2{

        text-align: center;
    }
    .company{
        border: solid 2px #EFEEEE;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

    .about {

        border: solid 2px gray;

        flex: 1; /* Take up half of the space */

        padding: 20px;

        border-radius: 10px;

    }

    .about p {

        text-align: left;

    }

    .job-box h3 {

        margin-bottom: 10px;

    }

    .job-company {

        font-style: italic;

        color: #666;

    }
    
    .company .btn {
        margin-top: 5px;
        padding: 0px 20px;
        text-decoration: none;
        border: solid 2px royalblue;
        border-radius: 5px;
        color: royalblue;
        width: 6%;
        height: 5.5%;
        box-sizing: border-box;
        text-align: center;
        white-space: nowrap;
        
        margin-left: 40%;
    }

    .company .btn:hover {
        color: white;
        background: royalblue;
    }
</style>



@include('partials.header')

<div class="pic-container">

<img class="background" src="/images/bg-image.png" alt="">

<div class="overlay">

    <div class="container content">

        <h1>Discover your next job opportunity and</h1>

        <h1>Take the next step in advancing your career with us</h1>

    </div>

    <div class="search-bar">

        <input type="text" placeholder="Search...">

        <button>Search</button>

    </div>

</div>

</div>

<div><br><br>

<div class="home-page">

    <div class="about">

        <h2>About Us</h2>

        <p>FindOne Now is more than just a platform; it's your partner in progress. Through personalized recommendations, innovative tools, and community events, we're here to support your journey every step of the way. Our success is intertwined with yours, and that's what makes FindOne Now more than a job portal – it's a shared adventure.

            Join us on this exciting journey where careers flourish, connections blossom, and dreams become reality. FindOne Now is not just a platform; it's a thriving community waiting to welcome you. Your next opportunity is just a click away!

        </p>

    </div><br><br>

    <div class="category">

        <h2>Categories</h2><br>

        <div class="category-boxes">

            @foreach($categories->take(6) as $category)

                <div class="category-box">

                    <h3>{{ $category->title }}</h3>
                    

                </div>

            @endforeach

        </div>

    </div><br><br>

    <div class="jobs"><br>

        <h2>Latest Jobs</h2><br>  

        <div class="job-boxes">

            @foreach($jobs->sortByDesc('created_at')->take(6) as $job)

                <div class="job-box">

                   <div class="title">
                    <h3>{{ $job->title }}</h3>
                   </div>
                    <p>We are in need of a Software development in our company.</p>

                    <div class="company">
                        <label>Company Name: {{ $job->user->company->name }}</label><br>
                        <label>Salary: {{ $job->salary }}</label><br><br>
                        <a href="{{ route('job', $job->id) }}" class="btn">Detail</a>

                    </div>

                    <span class="job-company">{{ $job->company }}</span>

                    <!-- Add other job details here -->

                </div>

            @endforeach

        </div>

    </div>

</div>

</div>
@include('partials.footer')