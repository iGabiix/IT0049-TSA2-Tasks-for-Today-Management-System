<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data['title'] = 'Profile';
        $data['user'] = $userModel->first();

        return view('profile', $data);
    }
}