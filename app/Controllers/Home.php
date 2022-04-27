<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\PageTypeModel;

class Home extends BaseController
{
    public $pageTypeModel;
    public $pageModel;
    public function __construct()
    {
        $this->pageTypeModel = new PageTypeModel();
        $this->pageModel = new PageModel();
    }

    public function index($slug)
    {
        session();
        $pageType = $this->pageTypeModel->where('slug', $slug)->asObject()->first();
        $data = [
            'validation'    => \config\Services::validation(),
            'pageType'  => $pageType,
            'page'  => $this->pageModel->where('page_type_id', $pageType->id)->asObject()->first(),
        ];
        return view('home', $data);
    }
}
