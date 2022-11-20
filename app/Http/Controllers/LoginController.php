<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class LoginController extends Controller
{
    public function index(){
        session_start();
        if (!isset($_SESSION['user'])){
            return redirect('/login');
        }
        else{
            return redirect('/home');
        }
    }
    
    public function checkLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::firstWhere([
            ['username', $request->input('username')],
            ['password', $request->input('password')]
        ]);

        if (filled($user)){
            session_start();
            session_unset();
            $_SESSION['user'] = $user;

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email_address' => $user->email_address,
                'phone_number' => $user->phone_number
            ]);
        }
        else{
            return response()->json([
                'error' => 'Invalid User'
            ]);
        }
    }

    public function logout(){
        session_start();
        session_destroy();
    }
}
