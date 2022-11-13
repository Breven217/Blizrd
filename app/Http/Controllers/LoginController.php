<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function checkLogin(LoginRequest $request){
        return 'test';
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

        return $user;
    }
}
