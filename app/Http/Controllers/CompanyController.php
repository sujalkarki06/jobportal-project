<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Company;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{
    public function showRegistrationForm()
{
    $user = Auth::user();
    $company = Company::where('user_id', $user->id)->first(); // Retrieve the company for the current user
    if ($company) {
        // Redirect to the update profile page if the user already has a registered company
        return redirect()->route('company.edit');
    }
    return view('company', ['user' => $user, 'company' => $company]);
}
    
    public function store(Request $request){
        // dd('dtored');
        if (Auth::check() && Auth::user()->role ==2) {
            $user_id = Auth::id();
            // Check if the user has already registered a company
        $existingCompany = Company::where('user_id', $user_id)->first();
        if ($existingCompany) {
            return redirect('/dashboard')->with('message', 'You have already registered a company!');
        }

            $name = $request->name;
            $address = $request->address;
            $office_phone = $request->office_phone;
            $mobile_phone = $request->mobile_phone;
            $profile = $request->profile;
            $URL = $request->URL;
            $logo = $request->logo;

            $logo_name = null;
         if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logo = $request->file('logo');   
            $logo_name = $logo->hashName();   
            $logo->move('uploads/', $logo_name);  
        }

             $user_id = Auth::id();
            $company = Company::create([
            'user_id'=>$user_id,
            'name'=>$name,
            'address'=>$address,
            'office_phone'=>$office_phone,
            'mobile_phone'=>$mobile_phone,
            'profile'=>$profile,
            'URL'=>$URL,
            'logo'=>$logo_name,
            ]);

            return redirect()->back()->with('success', 'Company registered successfully!');
    } else {
        return redirect('/dashboard')->with('error', 'You are not authorized to register a company!');
    }
    
    }
    public function edit(Request $request)
{
    $user = Auth::user();
    $company = Company::where('user_id', $user->id)->first(); // Retrieve only one company for the current user
    return view('company_update', [
        'company' => $company,
        'user' => $user
    ]);
}

    public function update(Request $request)
{
    $company = Company::find($request->company_id);

    // Check if the authenticated user is authorized to update the company
    if (Auth::check() && Auth::id() == $company->user_id) {
        $company->update([
            'name' => $request->name,
            'address' => $request->address,
            'office_phone' => $request->office_phone,
            'mobile_phone' => $request->mobile_phone,
            'profile' => $request->profile,
            'URL' => $request->URL,
        ]);

        // Handle logo update if a new logo is uploaded
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logo = $request->file('logo');
            $logo_name = $logo->hashName();
            $logo->move('uploads/', $logo_name);
            $company->update(['logo' => $logo_name]);
        }

        return redirect()->back()->with('success', 'Company updated successfully!');
    } else {
        return redirect('/dashboard')->with('error', 'You are not authorized to update this company!');
    }
}
}
