<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function index()
    {
        session();
        $data = [];
        return view('auth/index', $data);
    }

}
