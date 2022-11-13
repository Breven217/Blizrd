<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function checkLogin(Request $request){
       // $data = $request->validated();
        $user = User::firstWhere([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
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
            return response()->json([
                'error' => new Exception('Invalid User')
            ]);
        }
    }
}
