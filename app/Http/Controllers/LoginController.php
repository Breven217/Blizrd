<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * opening function routes to either home or login based on login status
     *
     * @return \Illuminate\Routing\Redirector 
     */
    public function index(){
        session_start();
        if (!isset($_SESSION['user'])){
            return redirect('/login');
        }
        else{
            return redirect('/home');
        }
    }
    
    /**
     * attempts to login the user based on the passed up username and password
     *
     * @param Request $request
     * @return JsonResponse
     */
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

    /**
     * logs the user out by destroying the phpsession holding the user information
     *
     * @return void
     */
    public function logout(){
        session_start();
        session_destroy();
    }
}
