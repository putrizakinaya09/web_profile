<?php

namespace App\Controllers;

use App\Models\ArticleCategoryModel;
use App\Models\ArticleCategoryRelationModel;
use App\Models\ArticleModel;
use App\Models\PageModel;
use App\Models\PageTypeModel;

class BeritaController extends BaseController
{
    public $pageTypeModel;
    public $pageModel;
    public $articleModel;

    public $articleCategoriesModel;

    public $articleCategoryRelationModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->articleCategoriesModel = new ArticleCategoryModel();
        $this->articleCategoryRelationModel = new ArticleCategoryRelationModel();
        $this->pageTypeModel = new PageTypeModel();
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        session();
        $uri = current_url(true);
        $uri = new \CodeIgniter\HTTP\URI($uri);
        $articles = $this->articleModel->asObject()->findAll();
        $datas = [];
        foreach ($articles as $key => $value) {
            $datas[$key]['id'] = $value->id;
            $datas[$key]['title'] = $value->title;
            $datas[$key]['content'] = $value->content;
            $datas[$key]['short_content'] = $this->strShort($value->content, 500);
            $datas[$key]['images'] = $value->images;
            $datas[$key]['status'] = $value->status == 1 ? 'Publish' : 'Draft';
            $datas[$key]['slug'] = $value->slug;
            $datas[$key]['date_ago'] = $this->getTime(strtotime($value->created_at));
            $datas[$key]['categories'] = $this->getDataCategories($value->id);
        }

        $data = [
            'uri'           => $uri,
            'title'         => 'Article / Berita',
            'articles'      => (object)$datas
        ];

        return view('berita/index', $data);
    }
    function strShort($string, $length, $lastLength = 0, $symbol = '...')
    {
        if (strlen($string) > $length) {
            $result = substr($string, 0, $length - $lastLength - strlen($symbol)) . $symbol;
            return $result . ($lastLength ? substr($string, -$lastLength) : '');
        }

        return $string;
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

    function getTime($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return 'less than ' . $etime . ' second ago';
        }

        $a = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60             =>  'hour',
            60                  =>  'minute',
            1                   =>  'second'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;

            if ($d >= 1) {
                $r = round($d);
                return 'about ' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    public function detail($slug)
    {
        $articles = $this->articleModel->where('slug', $slug)->asObject()->first();
        $id = $articles->id ?? '';
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
        ];
        return view('berita/detail', $data);
    }
}
