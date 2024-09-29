<style>
    form {
        width: 90%;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        background-color: #ffffff;
    border: 1px solid #ccc;
}
h2{
  text-align: center;
}

form > div {
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
    .input-box input[type="tel"],
    .input-box input[type="file"],
    .input-box input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .btn {
        
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

.btn:hover {
    background-color: royalblue;
    color: white;

}
.input-box img{
    width: 60px;
    height: auto;
}

</style>
@extends('layouts.userlayout')

@section('employer')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Profile</title>
</head>
<body>
<form action="{{ route('profile_update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>User Profile</h2>
    <div class="input-box ">
        @if(isset($user->photo))
            <p>Profile</p>
            <img src="{{ asset('uploads/' . $user->photo) }}" alt="Current photo">
        @endif
        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
    </div>

    <div class="input-group">
        <div class="input-box">
   <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
    <div class="input-box">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
    </div>

    <div class="input-group">
        <div class="input-box">
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" required>
        </div>
        <div class="input-box">
    <label for="phone">Phone No:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" value="{{ old('phone', $user->phone) }}" required>
        </div>
    </div>

    <div class="input-box ">
        <label for="photo">Photo</label>
        <input id="photo" type="file" name="photo" autofocus>
        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
    </div>


    <button class="btn" type="submit">Submit</button>
</form>
</body>
</html>

@endsection