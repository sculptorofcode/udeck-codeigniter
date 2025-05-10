<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->attemptLogin(
            $this->request->getPost('email'),
            $this->request->getPost('password')
        );

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Invalid login credentials');
        }

        // Set session
        $this->setUserSession($user);

        return redirect()->to('/dashboard')->with('success', 'Login successful');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        // Hash password before saving
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->save($userData);

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout successful');
    }

    private function setUserSession($user)
    {
        session()->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ]);
    }
}
