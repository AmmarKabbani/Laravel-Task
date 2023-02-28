<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class UserController extends Controller
{
    use HttpResponses;


    /**
     * get all info of specific user by his id
     * @param  int $userId
     */
    public function user_info(int $userId){
        $info = User::where('id' , $userId)->get();
        //check if $info has a value 
        if(json_decode($info , true)){
            return $this->success($info,'User information');
        }
        else{
            return $this->success('','User not found !');
        }
    }
}
