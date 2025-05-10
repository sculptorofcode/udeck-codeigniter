<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Redirect to dashboard if logged in, otherwise to login page
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        } else {
            return redirect()->to('login');
        }
    }
}
