 <!-- Session Status -->
 <x-auth-session-status class="mb-4" :status="session('status')" />

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
/*     background: royalblue; */
    background-size: cover;
    background-position: center;
}
.wrapper{
    width: 420px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    color: white;
    border-radius: 10px;
    padding: 30px 40px;
}
.wrapper h1{
    font-size: 36px;
    text-align: center;

}
.wrapper .input-box {
    position: relative;
    width: 100%;
    height: 50px ;
/*    background: salmon;*/
    margin: 30px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border:none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
    
}
.input-box input::placeholder{
    color: white;
}
.input-box i {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}
.wrapper .remember-forget{
     display: flex;
     justify-content: space-between;
     font-size: 14.5px;
     margin: -15px 0 15px;
}

.remember-forget{
    accent-color: #fff;
    margin-right: 3px;
}

.forget a{
    color: #fff;
    text-decoration: none;
}
.remember-forget{
    accent-color: #fff;
    margin-right: 3px;
}

.forget a{
    color: #fff;
    text-decoration: none;
}
.forget a:hover{
    text-decoration: underline;
}

.remember-forget a:hover{
    text-decoration: underline;
}
.wrapper .btn{
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

.wrapper .register-link{
    font-size: 14.4px;
    text-align: center;
    /* margin-top: 20px; */
    margin: 20px 0 15px;
}

.register-link p a {
    color: #fff;
    text-decoration: none;
    font-weight: none;
}

.register-link p a:hover{
    text-decoration: underline;

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

<div class="wrapper">

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1>LogIn</h1>

        <!-- Email Address -->
          <div class="input-box">
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-box">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input placeholder="Password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="remember-forget">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="forget">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div><br>  

            <button type="submit" class="btn">Login</button><br><br>

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
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>

    </form>

</div>