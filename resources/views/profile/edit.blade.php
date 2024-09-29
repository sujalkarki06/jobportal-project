@extends('layouts.userlayout')
<style>
    .password, .delete{
        background-color: #E2E2E2;
        
        margin-bottom: 5px;
        border: solid 1px #9C9B9B;
        outline: none;
         border-radius: 10px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    }
    
</style>
@section('employer')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div> --}}
            <div class="password">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
        </div>

        <div class="delete">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection