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
    public function register(Request $request) {
        // // uncomment these when we actually create the views
        // $data = $request->validate(
        //     [
        //         'first_name'=>'required|max:255',
        //         'last_name'=>'required|max:255',
        //         'job_role'=>'required|max:255',
        //         'dob'=>'required',
        //         'line_1'=>'required|max:255',
        //         'line_2'=>'required|max:255',
        //         'city'=>'required|max:255',
        //         'state'=>'required|max:255',
        //         'country'=>'required|max:255',
        //         'email'=>'required|unique|email|max:255',
        //         'password'=>'required',
        //         'confirm_password'=>'required'            
        //     ]
        // );

        echo "<script>console.log('hello world')</script>";

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

        $employee = new Employee([
            "id"=>(string) Str::uuid(),
            "first_name"=>$request->input('first_name'),
            "last_name"=>$request->input('last_name'),
            "dob"=>$request->input('dob'),
            "address_id"=>$address->id,
            "contact_id"=>$contact->id,
            "job_role_id"=>"d6353dd9-2e4a-4a21-81c4-9a4f16cef20c",
        ]);

        $user = new User([
            "id"=>(string) Str::uuid(),
            "email"=>$request->input('email'),
            "password"=>$request->input('password'),
            "user_role_id"=>"86efe04b-8be4-4c70-a240-fe9624d89371",
            "employee_id"=>$employee->id,
        ]);
        
        $address->save();
        $contact->save();
        $employee->save();
        $user->save();
        
        return redirect()->intended('/login');
    }
}
