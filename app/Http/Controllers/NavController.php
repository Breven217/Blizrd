<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller
{
    /**
     * returns the login view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function goLogin()
    {
        return view('login');
    }

    /**
     * returns the login view if a user is not logged in
     *
     * @return \Illuminate\Routing\Redirector|boolean
     */
    private function checkLoggedUser() 
    {
        session_start();
        if (!isset($_SESSION['user'])){
            return redirect('/login');
        }
        else{
            return true;
        }
    }

    /**
     * returns the Home view if a user is not logged in or the login view if not
     *
     * @return \Illuminate\Contracts\View\View|boolean
     */
    public function goHome()
    {
        $loggedIn = $this->checkLoggedUser();
        if($loggedIn) {
            return view('home');
        }
        else{
            return $loggedIn;
        }
        
    }

    /**
     * returns the management view if a user is not logged in or the login view if not
     *
     * @return \Illuminate\Contracts\View\View|boolean
     */
    public function goManagement()
    {
        $loggedIn = $this->checkLoggedUser();
        if($loggedIn) {
            return view('management');
        }
        else{
            return $loggedIn;
        }
    }
}
