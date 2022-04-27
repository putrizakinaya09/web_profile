<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleCategoryModel;
use CodeIgniter\Commands\Utilities\Publish;

class ArticleCategoriesController extends BaseController
{
    public $articleCategoryModel;
    public function __construct()
    {
        $this->articleCategoryModel = new ArticleCategoryModel();
    }

    public function index()
    {
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'title'         => 'Article / Berita Category',
            'categories'     => $this->articleCategoryModel->asObject()->findAll()
        ];
        return view('article-categories/index', $data);
    }

    public function create()
    {
        session();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'title'         => 'Article / Berita Category',
            'validation'    => \config\Services::validation()
        ];
        return view('article-categories/create', $data);
    }

    public function delete($id)
    {
        $this->articleCategoryModel->where('id', $id)->delete();
        return redirect()->to('/article-categories');
    }

    public function store()
    {
        if (!$this->validate([
            'name'   => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/article-categories/create')->withInput()->with('validation', $validation);
        }
        $name = $this->request->getVar('name');
        $data = [
            'name'   => $name,
        ];
        $this->articleCategoryModel->insert($data);
        return redirect()->to('/article-categories')->with('success', "Data berhasil ditambahkan");
    }


    public function edit($id)
    {
        session();
        $categories = $this->articleCategoryModel->where('id', $id)->asObject()->first();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'categories'     => $categories,
            'title'         => 'Article / Berita Category',
            'validation'    => \config\Services::validation()
        ];
        return view('article-categories/edit', $data);
    }


    public function update()
    {
        $id = $this->request->getVar('id');
        if (!$this->validate([
            'name'   => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/article-categories/' . $id . '/edit')->withInput()->with('validation', $validation);
        }

        $name = $this->request->getVar('name');
        $data = [
            'name'   => $name,
        ];
        $this->articleCategoryModel->updateData($id, $data);
        return redirect()->to('/article-categories')->with('success', "Data berhasil dirubah");
    }
}