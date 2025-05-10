<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AuthController
 *
 * BaseController for all controllers requiring authentication
 */
class AuthController extends BaseController
{
    /**
     * Check if the user is logged in, otherwise redirect to login
     */
    protected function checkAuth()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to access this page');
        }
    }
    
    /**
     * Get the current logged-in user's ID
     */
    protected function getUserId()
    {
        return session()->get('user_id');
    }
}
