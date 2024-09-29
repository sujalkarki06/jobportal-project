<style>
    * {
    margin: 0 ;
    padding: 0 ;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('/images/login.jpg') no-repeat;
    background-size: cover;
    background-position: center;
  }
  .wrapper {
    width: 420px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    color: white;
    border-radius: 10px;
    padding: 30px 40px;
  }
  .wrapper h1 {
    font-size: 36px;
    text-align: center;
  }
  .wrapper .input-box {
    position: relative;
    width: 100%;
    height: 50px;
    margin: 30px 0;
  }
  .input-box input::placeholder {
    color: white;
  }
  .input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
  }
  .input-box input::placeholder {
    color: white;
  }
  .wrapper .btn {
    width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
  }
  .wrapper .register-link {
    font-size: 14.4px;
    text-align: center;
    margin: 20px 0 15px;
  }
  .register-link a {
    color: #fff;
    text-decoration: none;
    font-weight: none;
  }
  .register-link a:hover {
    text-decoration: underline;
  }

  .modal {
    background-color: rgba(0, 0, 0, 0.8); /* Change the background color */
    opacity: 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transition: all 0.3s ease-in-out;
    z-index: -1;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .modal.open {
    opacity: 1;
    z-index: 999;
  }
  .modal-inner {
    /* background-color: #fff; */
    border-radius: 5px;
    box-shadow: 1px 4px rgba(0, 0, 0, 0.3);
    padding: 15px 25px;
    text-align: center;
    width: 380px;
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
  }
  .modal-inner h2 {
    margin: 0;
  }
  .modal-inner p {
    line-height: 24px;
    margin: 10px 0;
  }
  label:active {
    opacity: 0.8;
  }
    .modal button,
  .popup button {
    display: inline-block;
    width: calc(50% - 5px); /* Adjust spacing between labels */
    padding: 20px;
    background: rgba(255, 255, 255, 0.1); /* Adjust label background */
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    color: white;
    transition: background-color 0.3s ease;
  }

  .modal button:hover,
  .popup button:hover {
    background: rgba(255, 255, 255, 0.5); /* Adjust hover background */
  }

  .modal h2,
  .popup p {
    text-align: center;
    margin-bottom: 20px;
  }
  .popup {
      width: 420px;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(0, 0, 0, 0.7);
  color: #fff;
  padding: 20px;
  border-radius: 5px;
  display: none;

  border: 2px solid rgba(255, 255, 255, .2);
  backdrop-filter: blur(20px);
  box-shadow: 0 0 10px rgba(0, 0, 0, .1);
}
  .popup.show {
  display: block;
}
  
#successPopup button {
  /* background-image: linear-gradient(to right, #663399, #8853bd); */
  border-radius: 20px;
  border: 0;
  box-shadow: 0;
  /* color: #fff; */
  /* cursor: pointer; */
  padding: 10px 25px;
  margin-top: 20px;

  width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
}

#successPopup button:active {
  opacity: 0.8;
}

.or-register {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.line {
    flex: 1;
    height: 1px;
    background-color: #ccc;
    margin: 0 10px;
}
.social-media {
    display: flex;
    justify-content: center;
    align-items: center;
}

.icon {
    width: 30px; /* Adjust the size as needed */
    height: auto; /* Maintain aspect ratio */
    margin: 0 5px; /* Adjust spacing between icons */
}
</style>

{{-- <!-- Add role input field -->
<input type="hidden" id="role" name="role" value=""> 

<!-- Display validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<div class="wrapper">
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h1>Register</h1>

        <!-- Name -->
        <div class="input-box">
            {{-- <x-input-label for="name" :value="__('Name')" /> --}}
            <x-text-input placeholder="Name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-box">
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-box">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input placeholder="Password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="input-box">
            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

            <x-text-input placeholder="Confirm Password" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <input type="hidden" id="role" name="role" value=""> 

        <button class="btn">Register</button><br><br>

        <div class="link">
            <div class="or-register">
                <span class="line"></span>
                <span>or login with</span>
                <span class="line"></span>
            </div>
            <div class="social-media">
                <a href="https://facebook.com"><img class="icon" src="/images/facebook.png" alt="Facebook"></a>
                <a href="https://instagram.com"><img class="icon" src="/images/instagram.png" alt="Instagram"></a>
                <a href="https://linkedin.com"><img class="icon" src="/images/linkedin.png" alt="LinkedIn"></a>
                <a href="https://google.com"><img class="icon" src="/images/google.jpg" alt="Google"></a>
            </div>
        </div>


        <div class="register-link">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</div>
    <!-- Role selection modal -->
<div class="modal" id="modal">
    <div class="modal-inner">
        <h2>Choose Role</h2>
        <button id="jobseekerBtn" type="button" value="1">Jobseeker</button>
        <button id="employerBtn" type="button" value="2">Employer</button>

    </div>
</div>

{{-- <!-- Popup message element -->
<div class="popup" id="successPopup">
<p id="successMessage">Registered successfully!</p>
<button id="okButton">OK</button>
</div> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get form and modal elements
    const form = document.querySelector('form');
    const modal = document.getElementById('modal');
    const jobseekerBtn = document.getElementById('jobseekerBtn');
    const employerBtn = document.getElementById('employerBtn');
    const roleInput = document.getElementById('role');

    // Show modal when form is submitted
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        // Perform form validation
        if (validateForm()) {
            // Check password length and match
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            if (passwordInput.value.length < 8) {
                alert('Password must be at least 8 characters long.');
                return; // Stop further execution
            }
            if (passwordInput.value !== confirmPasswordInput.value) {
                alert('Passwords do not match.');
                return; // Stop further execution
            }
            
            // Show the role selection modal
            modal.classList.add('open');
        }
    });

    // Handle role selection
    jobseekerBtn.addEventListener('click', function() {
      // document.getElementById('role').value = '1';
        roleInput.value = 1; // Set role value for jobseeker
        form.submit(); // Submit the form
    });

    employerBtn.addEventListener('click', function() {
      // document.getElementById('role').value = '1';
        roleInput.value = 2; // Set role value for employer
        form.submit(); // Submit the form
    });

    // Function to validate form fields
    function validateForm() {
        // Implement your validation logic here
        // For simplicity, I'm assuming basic HTML5 validation
        return form.checkValidity();
    }
});

</script>