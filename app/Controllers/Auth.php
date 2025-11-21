<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            $session->setFlashdata('error', 'Username not found!');
            return redirect()->back();
        }

        if (!password_verify($password, $user['password'])) {
            $session->setFlashdata('error', 'Wrong password!');
            return redirect()->back();
        }

        // Set session
        $session->set([
            'logged_in' => true,
            'username'  => $user['username'],
            'user_id'   => $user['id'],
        ]);

        // Redirect to dashboard view
        return redirect()->route('dashboard'); // use named route
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
