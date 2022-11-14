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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::firstWhere([
            ['username', $request->input('username')],
            ['password', $request->input('password')]
        ]);

        if (filled($user)){
            return redirect()->intended('home');
        }
        else{
            return response()->json([
                'error' => 'Invalid User'
            ]);
        }
    }

    public function goHome(){
        return view('home');
    }
}
