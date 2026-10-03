<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/tasks');
        }

        return view('login', ['title' => 'Login']);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = (new UserModel())->where('username', $this->request->getPost('username'))->first();

        if ($user === null || ! password_verify((string) $this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        session()->regenerate(true);
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/tasks')->with('message', 'Welcome back, ' . $user['username'] . '.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('message', 'You have been logged out.');
    }
}
