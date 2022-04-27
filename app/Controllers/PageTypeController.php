<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PageTypeModel;
use CodeIgniter\Commands\Utilities\Publish;

class PageTypeController extends BaseController
{
    public $pageTypeModel;
    public function __construct()
    {
        $this->pageTypeModel = new PageTypeModel();
    }

    public function index()
    {
        $data = [
            'mahasiswa'  => $this->pageTypeModel->asObject()->findAll()
        ];
        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        session();
        $data = [
            'validation'    => \config\Services::validation()
        ];
        return view('mahasiswa/create', $data);
    }

    public function delete($id)
    {
        $this->pageTypeModel->where('id', $id)->delete();
        return redirect()->to('/mahasiswa');
    }

    public function store()
    {
        if (!$this->validate([
            'nim'   => 'required',
            'nama_mahasiswa'   => 'required'
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/mahasiswa/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'nim'   => $this->request->getVar('nim'),
            'nama_mahasiswa'   => $this->request->getVar('nama_mahasiswa'),
        ];
        $this->pageTypeModel->insert($data);
        return redirect()->to('/mahasiswa')->with('success', "Data berhasil ditambahkan");
    }


    public function edit($id)
    {
        session();
        $mahasiswa = $this->pageTypeModel->where('id', $id)->asObject()->first();
        $data = [
            'mahasiswa'       => $mahasiswa,
            'validation'    => \config\Services::validation()
        ];
        return view('mahasiswa/edit', $data);
    }


    public function update()
    {
        $id = $this->request->getVar('id');

        $data = [
            'nim'   => $this->request->getVar('nim'),
            'nama_mahasiswa'   => $this->request->getVar('nama_mahasiswa'),
        ];

        if (!$this->validate([
            'nim'   => 'required',
            'nama_mahasiswa'   => 'required'
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/mahasiswa/' . $id . '/edit')->withInput()->with('validation', $validation);
        }

        $this->pageTypeModel->updateData($id, $data);
        return redirect()->to('/mahasiswa')->with('success', "Data berhasil dirubah");
    }
}