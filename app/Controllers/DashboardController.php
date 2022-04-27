<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        session();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'    => $uri,
        ];
        return view('dashboard/index', $data);
    }

}
