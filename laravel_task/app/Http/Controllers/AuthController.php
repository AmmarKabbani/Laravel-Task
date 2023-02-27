<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
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
            'date_of_birth' => 'required|date_format:m/d/Y',
            'gender' => 'in:Male,Female',
            'email' => 'required|email',
            'phone_number' => 'digits:10|unique',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ],[
            'gender.in' => 'must be Male or Female',
            'date_of_birth.date_format' => 'must be in m/d/Y format like : 01/01/2000'
        ]
        );
        // return the error and info about it if something wrong with user input 
        if ($validator->fails()) {
            return $validator->errors();
        }

        return $this->success('','check successfully');
    }
}
