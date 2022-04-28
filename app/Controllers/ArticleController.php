<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleCategoryModel;
use App\Models\ArticleCategoryRelationModel;
use App\Models\ArticleModel;
use CodeIgniter\Commands\Utilities\Publish;

class ArticleController extends BaseController
{
    public $articleModel;

    public $articleCategoriesModel;

    public $articleCategoryRelationModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->articleCategoriesModel = new ArticleCategoryModel();
        $this->articleCategoryRelationModel = new ArticleCategoryRelationModel();
    }

    public function index()
    {
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $articles = $this->articleModel->asObject()->findAll();
        $datas = [];
        foreach ($articles as $key => $value) {
            $datas[$key]['id'] = $value->id;
            $datas[$key]['title'] = $value->title;
            $datas[$key]['content'] = $value->content;
            $datas[$key]['images'] = $value->images;
            $datas[$key]['status'] = $value->status == 1 ? 'Publish' : 'Draft';
            $datas[$key]['slug'] = $value->slug;            
            $datas[$key]['categories'] = $this->getDataCategories($value->id);
        }

        $data = [
            'uri'           => $uri,
            'title'         => 'Article / Berita',
            'articles'      => (object)$datas
        ];

        return view('articles/index', $data);
    }

    public function getDataCategories($id)
    {
        $relations = $this->articleCategoryRelationModel->where('article_id', $id)->asObject()->findAll();
        $ids = [];
        foreach ($relations as $value) {
            $ids[] = $this->articleCategoriesModel->where('id', $value->category_id)->asObject()->first();
        }
        return $ids;
    }

    public function create()
    {
        session();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'title'         => 'Article / Berita',
            'validation'    => \config\Services::validation(),
            'categories'    =>  $this->articleCategoriesModel->asObject()->findAll(),
        ];
        return view('articles/create', $data);
    }

    public function delete($id)
    {
        $this->articleModel->where('id', $id)->delete();
        return redirect()->to('/articles');
    }

    public function store()
    {
        if (!$this->validate([
            'title'   => 'required',
            'categories' => 'required',
            'content' => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/articles/create')->withInput()->with('validation', $validation);
        }
        $title      = $this->request->getVar('title');
        $categories = $this->request->getVar('categories');
        $slug       = $this->request->getVar('slug');
        $status     = $this->request->getVar('status');
        $content    = $this->request->getVar('content');

        $images = $this->request->getFile('images');
        $imageName = null;
        if ($images->isValid()) {
            $upload = $images->move(FCPATH . 'assets/images');

            if ($upload) {
                $imageName = $images->getName();
            }
        }


        if (empty($slug)) {
            $slug = preg_replace('/\s+/', '-', trim(strtolower($title)));
        }
        $this->articleModel->transBegin();
        $data = [
            'title'     => $title,
            'slug'      => $slug,
            'images'    => $imageName,
            'content'   => $content,
            'status'    => $status,
            'created_by' => session()->get('id'),
            'updated_by' => session()->get('id'),
        ];
        $id = $this->articleModel->insert($data);

        foreach ($categories as $value) {
            $data = [
                'article_id' => $id,
                'category_id' => $value,
            ];
            $this->articleCategoryRelationModel->insert($data);
        }
        if ($this->articleModel->transStatus() === false) {
            $this->articleModel->transRollback();
        } else {
            $this->articleModel->transCommit();
        }
        return redirect()->to('/articles')->with('success', "Data berhasil ditambahkan");
    }


    public function edit($id)
    {
        session();
        $articles = $this->articleModel->where('id', $id)->asObject()->first();
        $relations = $this->articleCategoryRelationModel->where('article_id', $id)->asObject()->findAll();
        $ids = [];
        foreach ($relations as $key => $value) {
            $ids[] = $value->category_id;
        }
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $data = [
            'uri'           => $uri,
            'articles'      => $articles,
            'title'         => 'Article / Berita',
            'validation'    => \config\Services::validation(),
            'categories'    =>  $this->articleCategoriesModel->asObject()->findAll(),
            'categories_relation'    =>  $ids,
        ];

        return view('articles/edit', $data);
    }


    public function update()
    {
        $id = $this->request->getVar('id');
        if (!$this->validate([
            'title'   => 'required',
            'categories' => 'required',
            'content' => 'required',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/articles/' . $id . '/edit')->withInput()->with('validation', $validation);
        }

        $title      = $this->request->getVar('title');
        $categories = $this->request->getVar('categories');
        $slug       = $this->request->getVar('slug');
        $status     = $this->request->getVar('status');
        $content    = $this->request->getVar('content');

        $images = $this->request->getFile('images');
        $imageName = null;
        if ($images->isValid()) {
            $upload = $images->move(FCPATH . 'assets/images');

            if ($upload) {
                $imageName = $images->getName();
            }
        }

        if (empty($slug)) {
            $slug = preg_replace('/\s+/', '-', trim(strtolower($title)));
        }
        $this->articleModel->transBegin();
        $data = [
            'title'     => $title,
            'slug'      => $slug,
            'content'   => $content,
            'status'    => $status,
            'updated_by' => session()->get('id'),
        ];
        $imageData = [
            'images'    => $imageName,
        ];
        if ($imageName) {
            $data = array_merge($data, $imageData);
        }
        $this->articleModel->updateData($id, $data);
        $this->articleCategoryRelationModel->where('article_id', $id)->delete();
        foreach ($categories as $value) {
            $data = [
                'article_id' => $id,
                'category_id' => $value,
            ];
            $this->articleCategoryRelationModel->insert($data);
        }
        if ($this->articleModel->transStatus() === false) {
            $this->articleModel->transRollback();
        } else {
            $this->articleModel->transCommit();
        }

        return redirect()->to('/articles')->with('success', "Data berhasil dirubah");
    }
}
