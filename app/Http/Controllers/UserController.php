<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Address;
use App\Models\Contact;
use App\Models\JobRole;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class UserController extends Controller
{
    public function register(Request $request) {
        // // uncomment these when we actually create the views
        $data = $request->validate(
            [
                'first_name'=>'required|max:255',
                'last_name'=>'required|max:255',
                'job_role'=>'required|max:255',
                'dob'=>'required',
                'line_1'=>'required|max:255',
                'line_2'=>'required|max:255',
                'city'=>'required|max:255',
                'state'=>'required|max:255',
                'country'=>'required|max:255',
                'email'=>'required|unique:users|email|max:255',
                'password'=>'required',
                'confirm_password'=>'required'            
            ],
            [
                'dob.date' => 'The date of birth must be a valid date.',
                'email.unique' => 'The email has already been taken.',
                'confirm_password.same' => 'The password confirmation does not match.',
            ]
        );

        $dob = Carbon::parse($data['dob']);

        if ($dob->age < 18) {
            return redirect()->back()->withInput()->withErrors(['dob' => 'You must be at least 18 years old to register.']);
        }

        // create Address
        // create Contact
        // create Employee and link to newly created address and contact
        // create User
        // link user to user_role and employee
    try {
        $address = new Address([
            "id"=>(string) Str::uuid(),
            "line_1"=>$request->input('line_1'),
            "line_2"=>$request->input('line_2'),
            "city"=>$request->input('city'),
            "state"=>$request->input('state'),
            "country"=>$request->input('country'),
            "company_address"=>false,
        ]);

        $contact = new Contact([
            "id"=>(string) Str::uuid(),
            "primary_number"=>$request->input('primary_number'),
            "secondary_number"=>$request->input('secondary_number'),
            "email"=>$request->input('email'),
        ]);

        // write an if statement to hardcode role id
        if ($request->input('job_role')=='cashier'){
            $employee = new Employee([
                "id"=>(string) Str::uuid(),
                "first_name"=>$request->input('first_name'),
                "last_name"=>$request->input('last_name'),
                "dob"=>$request->input('dob'),
                "address_id"=>$address->id,
                "contact_id"=>$contact->id,
                "job_role_id"=>"8821d316-6ee2-4f70-bfc8-917b4219f7d3",
            ]);
        }

        else {
            $employee = new Employee([
                "id"=>(string) Str::uuid(),
                "first_name"=>$request->input('first_name'),
                "last_name"=>$request->input('last_name'),
                "dob"=>$request->input('dob'),
                "address_id"=>$address->id,
                "contact_id"=>$contact->id,
                "job_role_id"=>"d6353dd9-2e4a-4a21-81c4-9a4f16cef20c",
            ]);
        }

        if ($request->input('job_role') == 'cashier'){
            $user = new User([
                "id"=>(string) Str::uuid(),
                "email"=>$request->input('email'),
                "password"=>$request->input('password'),
                "user_role_id"=>"eff3a740-b777-48dc-8c04-78893ba6a50b",
                "employee_id"=>$employee->id,
            ]);
        }

        else {
            $user = new User([
                "id"=>(string) Str::uuid(),
                "email"=>$request->input('email'),
                "password"=>$request->input('password'),
                "user_role_id"=>"86efe04b-8be4-4c70-a240-fe9624d89371",
                "employee_id"=>$employee->id,
            ]);
        }
        
        $address->save();
        $contact->save();
        $employee->save();
        $user->save();
        
        return redirect()->intended('/login');

    } catch (QueryException $e) {
        if ($e->errorInfo[1] === 23505) {
            // Duplicate entry error for email
            return redirect()->back()->withInput()->withErrors(['email' => 'The email has already been taken.']);
        } else {
            // Handle other database errors
            return redirect()->route('register_error')->with('register_error', 'An error occurred. Please try again later.');
            }
        }
    }
}