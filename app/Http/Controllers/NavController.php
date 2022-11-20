<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller
{
    public function goLogin(){
        return view('login');
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
}
