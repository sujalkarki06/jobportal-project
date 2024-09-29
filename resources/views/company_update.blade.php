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

    .content-section .btn {
        width: 15%;
        height: 45px;
        background: #fff;
        /* background: royalblue; */
        border: none;
        outline: none;
        /* border-radius: 40px; */
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .content-section .btn:hover {
        background-color: royalblue;
        color: white;
    }

    .popup {
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

    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

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
    .input-box img{
    width: 70px;
    height: auto;
}
</style>

@if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
            window.location.href = "/dashboard";
        }
    </script>
@endif

@if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
            window.location.href = "/dashboard";
        }
    </script>
@endif

@if(session('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        }
    </script>
@endif

<div class="content-section">
    <form id="updateForm" method="POST" action="{{ route('company.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH') <!-- Specify the HTTP method as PATCH -->
        <input type="hidden" name="company_id" value="{{ $company->id }}"> <!-- Add a hidden input field for company_id -->
        <h1>Profile</h1>

        <div class="input-box full-width">
            @if(isset($company->logo))
                <p>Current Logo:</p>
                <img src="{{ asset('uploads/' . $company->logo) }}" alt="Current Logo">
            @endif
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
        </div>

        <div class="input-group">
            <!-- Company Name -->
            <div class="input-box">
                <label for="company_name">Company Name</label>
                <input id="company_name" type="text" name="name" value="{{ old('name', $company->name ?? '') }}" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Company Address -->
            <div class="input-box">
                <label for="company_address">Company Address</label>
                <input id="company_address" type="text" name="address"
                value="{{ old('address',$company->address ?? '' )}}" required autofocus>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <div class="input-group">
            <!-- Office Phone Number -->
            <div class="input-box">
                <label for="office_phone">Office Phone number</label>
                <input id="office_phone" type="tel" name="office_phone" value="{{ old('office_phone',$company->office_phone ?? '' )}}" pattern="[0-9]+" required autofocus>
                <x-input-error :messages="$errors->get('office_phone')" class="mt-2" />
            </div>

            <!-- Company Website -->
            <div class="input-box">
                <label for="company_website">Company Website</label>
                <input id="company_website" type="text" name="URL" value="{{ old('company_website', $company->URL ?? '') }}" required autofocus>
                <x-input-error :messages="$errors->get('URL')" class="mt-2" />
            </div>
        </div>

        <div class="input-group">
            <!-- Contact Person Fullname -->
            <div class="input-box">
                <label for="contact_person">Contact Person Fullname</label>
                <input id="contact_person" type="text" name="contact_person"
                    value="{{ old('contact_person', $user->name) }}"
                    required autofocus>
                <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
            </div>

            <!-- Mobile Number -->
            <div class="input-box">
                <label for="mobile_phone">Mobile number</label>
                <input id="mobile_phone" type="tel" name="mobile_phone" pattern="[0-9]+"
       value="{{ old('mobile_phone', $company->mobile_phone ?? '') }}" required autofocus>

                <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
            </div>
        </div>

        <!-- Company Short Intro -->
        <div class="input-box full-width">
            <label for="company_intro">Company Short Intro</label>
            <textarea id="company_intro" name="profile" class="custom-textarea" rows="5" required>{{ old('profile', $company->profile ?? '') }}></textarea>
            <x-input-error :messages="$errors->get('profile')" class="mt-2" />
        </div>

        <!-- Company Logo -->
        <div class="input-box full-width">
            <label for="company_logo">Company Logo</label>
            <input id="company_logo" type="file" name="logo" autofocus>
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
        </div>
        
        <!-- Submit Button -->
        <button class="btn" type="submit">Submit</button>
    </form>
</div>

@endsection