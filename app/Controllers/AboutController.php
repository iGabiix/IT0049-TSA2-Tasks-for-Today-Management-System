<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index()
    {
        $data['title'] = 'About';

        return view('about', $data);
    }
}