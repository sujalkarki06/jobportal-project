<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd('saved0');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function edit(Request $request){
        return view('profile', [
            'user' => $request->user(),
        ]);
    }
    public function submitProfile(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Update the user's profile information
    $user->name = $request->name;
    $user->email = $request->email;
    $user->address = $request->address;
    $user->phone = $request->phone;

    // Handle photo upload
    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $photo = $request->file('photo');   
        $photo_name = $photo->hashName();   
        $photo->move('uploads/', $photo_name);
        $user->photo = $photo_name; // Update the user's photo field with the new photo name
    }

    // Save the changes to the user's profile
    $user->save();

    // Redirect back to the profile edit page with a success message
    return redirect()->route('profile_update')->with('success', 'Profile updated successfully.');
}

}
