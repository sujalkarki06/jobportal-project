<style>
    section{
        margin-right: 15px;
        margin-left: 15px;
        margin-top: 15px;
        margin-bottom: 15px;
        
    }
    .input{
        width: 50%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 10px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    .btn{
        width: 10%;
        height: 35px;
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
</style>
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            {{-- <x-input-label for="update_password_current_password" :value="__('Current Password')" /> --}}
            <label for="update_password_current_password">Current Password</label>
            <input type="text" class="input" id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" >
            {{-- <x-text-input class="input" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            {{-- <x-input-label for="update_password_password" :value="__('New Password')" /> --}}
            <label for="update_password_current_password">New Password</label>
            <input type="text" class="input" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password"  >
            {{-- <x-text-input class="input" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            {{-- <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" /> --}}
            <label for="update_password_current_password">Confirm Password</label>
            <input type="text" class="input" id="update_password_password_confirmation" name="password_confirmation" type="password"  autocomplete="new-password">
            {{-- <x-text-input class="input" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}
            <button class="btn">Save</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
