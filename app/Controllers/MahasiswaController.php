<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\Commands\Utilities\Publish;

class MahasiswaController extends BaseController
{
    public $mahasiswaModel;
    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $data = [
            'mahasiswa'  => $this->mahasiswaModel->asObject()->findAll()
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
        $this->mahasiswaModel->where('id', $id)->delete();
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
        $this->mahasiswaModel->insert($data);
        return redirect()->to('/mahasiswa')->with('success', "Data berhasil ditambahkan");
    }


    public function edit($id)
    {
        session();
        $mahasiswa = $this->mahasiswaModel->where('id', $id)->asObject()->first();
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

        $this->mahasiswaModel->updateData($id, $data);
        return redirect()->to('/mahasiswa')->with('success', "Data berhasil dirubah");
    }
}
