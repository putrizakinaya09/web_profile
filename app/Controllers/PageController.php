<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PageModel;
use App\Models\PageTypeModel;
use CodeIgniter\Commands\Utilities\Publish;

class PageController extends BaseController
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
        if (!empty($pageType)) {
            $page = $this->pageModel->where('page_type_id', $pageType->id)->asObject()->first();
        }
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'    => $uri,
            'validation'    => \config\Services::validation(),
            'pageType'  => $pageType,
            'page'  => $page ?? [],
        ];
        return view('pages/create', $data);
    }

    public function store($slug)
    {
        if (!$this->validate([
            'title'   => 'required',
            'content'   => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/page/'.$slug)->withInput()->with('validation', $validation);
        }

        $id = $this->request->getVar('id');
        $title = $this->request->getVar('title');
        $page_type_id = $this->request->getVar('page_type_id');
        $content = $this->request->getVar('content');
        $data = [
            'title' => $title,
            'page_type_id' => $page_type_id,
            'content' => $content,
            'status' => 1,
            'created_by' => session()->get('id'),
            'updated_by' => session()->get('id'),
        ];
        $pageType = $this->pageTypeModel->where('slug', $slug)->asObject()->first();
        if (!empty($pageType)) {
            $checkPage = $this->pageModel->where('page_type_id', $pageType->id)->asObject()->first();
            if(!empty($checkPage)){
                $this->pageModel->update($id, $data);
                return redirect()->to('/page/'.$slug)->with('success', "Data berhasil update");
            } else {
                $this->pageModel->insert($data);
                return redirect()->to('/page/'.$slug)->with('success', "Data berhasil simpan");
            }
        }
    }
}
