<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function login(Request $request)
    {


        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Your password is incorrect',
            ]);
        }
        
        return redirect()->intended('/dashboard');
    }

    public function register(Request $request) {
        // uncomment these when we actually create the views
        // $data = $request->validate(
        //     [
        //         'first_name'=>'required|max:255',
        //         'last_name'=>'required|max:255',
        //         'dob'=>'required|date',
        //         'email'=>'required|unique|email|max:255',
        //         'password'=>'required',
        //         'confirm_password'=>'required'
        //     ]
        // );

        // if (floor(date("Y-m-d") - $request->input('dob')) < 18) {
        //     echo "Under aged";
        //     return redirect()->intended('/login');
        // }

        // create Address
        // create Contact
        // create Employee and link to newly created address and contact
        // create User
        // link user to user_role and employee
        
        $address = new Address([
            "id"=>(string) Str::uuid(),
            "line_1"=>"something address",
            "line_2"=>"something address",
            "city"=>"something city",
            "state"=>"something state",
            "country"=>"something country",
        ]);

        $contact = new Contact([
            "id"=>(string) Str::uuid(),
            "primary_number"=>"355552",
            "secondary_number"=>"355552",
            "email"=>"something email",
        ]);

        $employee = new Employee([
            "id"=>(string) Str::uuid(),
            "first_name"=>'first_name',
            "last_name"=>'last_name',
            "dob"=>'yy-mm-dd',
            "address_id"=>$address->id,
            "contact_id"=>$contact->id,
            "job_role_id"=>"d6353dd9-2e4a-4a21-81c4-9a4f16cef20c",
        ]);

        $user = new User([
            "id"=>(string) Str::uuid(),
            "email"=>'email3@gmail.com',
            "password"=>'password',
            "user_role_id"=>"86efe04b-8be4-4c70-a240-fe9624d89371",
            "employee_id"=>$employee->id,
        ]);
        
        $address->save();
        $contact->save();
        $employee->save();
        $user->save();
        
    }
}
