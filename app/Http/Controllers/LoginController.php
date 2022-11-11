<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        $gamer = "Gib Soobieb";
        return view('login', compact($gamer));
    }
}
