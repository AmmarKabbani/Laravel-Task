<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * register a new user
     * @param Request $request
     */
    public function register(Request $request)
    {
        
        // validation on user input
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required|string|min:5',
            'last_name' => 'required|string|min:5',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'gender' => 'in:Male,Female',
            'email' => 'required|email',
            'phone_number' => 'digits:10|unique',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ],[
            'gender.in' => 'must be Male or Female',
            'date_of_birth.date_format' => 'must be in Y-m-d format like : 2023-02-27'
        ]
        );
        /**
         * return the error and info about it if something wrong with user input  
        */ 
        if ($validator->fails()) {
            return $validator->errors();
        }

        /**
         * store user info in DB
         */
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return $this->success('','Registered Successfully');
    }

    public function login(Request $request)
    {
        // validation on user input
        $validator = Validator::make($request->all(), [ 
            'username' => 'required',
            'password' => 'required',
        ]);

        /**
         * return the error and info about it if something wrong with user input  
        */ 
        if ($validator->fails()) {
            return $validator->errors();
        }

        // Check if the username and password match in Database 
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Success
            $userInfo = User::all();
            return $this->success($userInfo,'Logged in Successfully');
        } else {
            // fail
            return $this->error('The Username or password you’ve entered is incorrect',403);
        }
    }
}
