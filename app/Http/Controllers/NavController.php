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
    }

    public function goHome()
    {
        $this->checkLoggedUser();
        return view('home');
    }

    public function goManagement()
    {
        $this->checkLoggedUser();
        return view('management');
    }
}
