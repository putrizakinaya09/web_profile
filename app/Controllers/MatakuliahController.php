<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MatakuliahModel;
use CodeIgniter\Commands\Utilities\Publish;

class MatakuliahController extends BaseController
{
    public $matakuliahModel;
    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
    }

    public function index()
    {
        $data = [
            'matakuliah'  => $this->matakuliahModel->asObject()->findAll()
        ];
        return view('matakuliah/index', $data);
    }

    public function create()
    {
        session();
        $data = [
            'validation'    => \config\Services::validation()
        ];
        return view('matakuliah/create', $data);
    }

    public function delete($id)
    {
        $this->matakuliahModel->where('id', $id)->delete();
        return redirect()->to('/matakuliah');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_matakuliah'   => 'required',
            'jadwal_absensi'   => 'required',
            'hari'   => 'required'
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/matakuliah/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_matakuliah'   => $this->request->getVar('nama_matakuliah'),
            'jadwal_absensi'   => $this->request->getVar('jadwal_absensi'),
            'hari'   => $this->request->getVar('hari'),
        ];
        $this->matakuliahModel->insert($data);
        return redirect()->to('/matakuliah')->with('success', "Data berhasil ditambahkan");
    }


    public function edit($id)
    {
        session();
        $matakuliah = $this->matakuliahModel->where('id', $id)->asObject()->first();
        $data = [
            'matakuliah'       => $matakuliah,
            'validation'    => \config\Services::validation()
        ];
        return view('matakuliah/edit', $data);
    }


    public function update()
    {
        $id = $this->request->getVar('id');

        $data = [
            'nama_matakuliah'   => $this->request->getVar('nama_matakuliah'),
            'jadwal_absensi'   => $this->request->getVar('jadwal_absensi'),
            'hari'   => $this->request->getVar('hari'),
        ];

        if (!$this->validate([
            'nama_matakuliah'   => 'required',
            'jadwal_absensi'   => 'required',
            'hari'   => 'required'
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/matakuliah/' . $id . '/edit')->withInput()->with('validation', $validation);
        }

        $this->matakuliahModel->updateData($id, $data);
        return redirect()->to('/matakuliah')->with('success', "Data berhasil dirubah");
    }
}
