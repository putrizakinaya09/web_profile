<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\PageTypeModel;

class BeritaController extends BaseController
{
    public $pageTypeModel;
    public $pageModel;
    public function __construct()
    {
        $this->pageTypeModel = new PageTypeModel();
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        session();
        $data = [];
        return view('berita/index', $data);
    }
}
