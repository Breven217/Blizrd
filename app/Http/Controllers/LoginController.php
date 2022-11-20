<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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

    public function goLogin(){
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

    public function goHome(){
        session_start();
        if (!isset($_SESSION['user'])){
            return redirect('/login');
        }
        else{
            return view('home');
        }
    }

    public function test(){
        return file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=41.68417&lon=-111.67957&appid=54a6d10f3bffb5d3e5e67b9fa58a63a6");
    }
}
