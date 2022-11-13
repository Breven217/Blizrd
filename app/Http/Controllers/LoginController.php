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
        return 'test';
        $data = $request->validated();
        $user = User::firstWhere([
            'username' => $data('username'),
            'password' => $data('password'),
        ]);


        if (filled($user)){
            return response()->json([
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email_address,
                'phone_number' => $user->phone_number
            ]);
        }
        else{
            return new Exception('Invalid User');
        }
    }
}
