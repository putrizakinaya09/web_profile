<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PageTypeModel;
use CodeIgniter\Commands\Utilities\Publish;

class ArticleController extends BaseController
{
    public $pageTypeModel;
    public function __construct()
    {
        $this->pageTypeModel = new PageTypeModel();
    }

    public function index()
    {
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'title'         => 'Pengaturan Halaman',
            'pageTypes'     => $this->pageTypeModel->asObject()->findAll()
        ];
        return view('page-types/index', $data);
    }

    public function create()
    {
        session();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'title'         => 'Pengaturan Halaman',
            'validation'    => \config\Services::validation()
        ];
        return view('page-types/create', $data);
    }

    public function delete($id)
    {
        $this->pageTypeModel->where('id', $id)->delete();
        return redirect()->to('/page-types');
    }

    public function store()
    {
        if (!$this->validate([
            'name'   => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/page-types/create')->withInput()->with('validation', $validation);
        }
        $name = $this->request->getVar('name');
        $slug = $this->request->getVar('slug');
        if (empty($slug)) {
            $slug = preg_replace('/\s+/', '-', trim(strtolower($name)));
        }
        $data = [
            'name'   => $name,
            'slug'   => $slug,
        ];
        $this->pageTypeModel->insert($data);
        return redirect()->to('/page-types')->with('success', "Data berhasil ditambahkan");
    }


    public function edit($id)
    {
        session();
        $pageTypes = $this->pageTypeModel->where('id', $id)->asObject()->first();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'pageTypes'     => $pageTypes,
            'title'         => 'Pengaturan Halaman',
            'validation'    => \config\Services::validation()
        ];
        return view('page-types/edit', $data);
    }


    public function update()
    {
        $id = $this->request->getVar('id');
        if (!$this->validate([
            'name'   => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/page-types/' . $id . '/edit')->withInput()->with('validation', $validation);
        }

        $name = $this->request->getVar('name');
        $slug = $this->request->getVar('slug');
        if (empty($slug)) {
            $slug = preg_replace('/\s+/', '-', trim(strtolower($name)));
        }
        $data = [
            'name'   => $name,
            'slug'   => $slug,
        ];
        $this->pageTypeModel->updateData($id, $data);
        return redirect()->to('/page-types')->with('success', "Data berhasil dirubah");
    }
}