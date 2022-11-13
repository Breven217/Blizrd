<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function checkLogin(LoginRequest $request){
        $user = User::where([
            'username' => $request->validated('username'),
            'password' => $request->validated('password'),
        ])
        ->select([
            'name',
            'username',
            'phone_number',
            'email_address'
        ])->first();

        if (filled($user)){
            return $user;
        }
        else{
            throw new Exception('Invalid User');
        }
    }
}
