<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        session();
        $data = [];
        return view('dashboard/index', $data);
    }

}
