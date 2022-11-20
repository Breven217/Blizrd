<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller
{
    public function goLogin()
    {
        return view('login');
    }

    private function checkLoggedUser() 
    {
        session_start();
        if (!isset($_SESSION['user'])){
            return redirect('/login');
        }
        else{
            return false;
        }
    }

    public function goHome()
    {
        $loggedIn = $this->checkLoggedUser();
        if(!$loggedIn) {
            return view('home');
        }
        else{
            return $loggedIn;
        }
        
    }

    public function goManagement()
    {
        $loggedIn = $this->checkLoggedUser();
        if(!$loggedIn) {
            return view('management');
        }
        else{
            return $loggedIn;
        }
    }
}
