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
        $user = User::firstWhere('username',$request->input('username'));

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
                'error' => 'Invalid User',
                'username' => $request->all()
            ]);
        }
    }
}
