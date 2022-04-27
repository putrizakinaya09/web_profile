<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;

use App\Models\MahasiswaModel;

use App\Models\PresensiModel;

class Home extends BaseController
{
    public $matakuliahModel;

    public $mahasiswaModel;

    public $presensiModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->presensiModel = new PresensiModel();
    }

    public function index()
    {
        session();
        $data = [
            'validation'    => \config\Services::validation(),
        ];
        return view('home', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nim'   => 'required',
            'ip_address'   => 'required',
            'id_matakuliah'   => 'required'
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/')->withInput()->with('validation', $validation);
        }

        $nim = $this->request->getVar('nim');
        $id_matakuliah = $this->request->getVar('id_matakuliah');
        $ip_address = $this->request->getVar('ip_address');

        $matakuliah = $this->matakuliahModel->where('id', $id_matakuliah)->asObject()->first();

        $jadwal_absensi = $matakuliah->jadwal_absensi;
        $hari = $this->getHariEnglish($matakuliah->hari);
        $hari_ini = date('l');
        if ($hari !== $hari_ini) {
            return redirect()->to('/')->with('error', "presensi gagal, jadwal untuk hari " . $matakuliah->hari);
        }
        $jadwal_absensi = date('Y-m-d ' . $jadwal_absensi);
        if (date('Y-m-d H:i') <= $jadwal_absensi) {
            return redirect()->to('/')->with('error', "presensi gagal, belum waktu untuk jadwal absensi");
        }

        $mahasiswa = $this->mahasiswaModel->where('nim', $nim)->asObject()->first();
        if (!empty($mahasiswa)) {
            $mahasiswa_id = $mahasiswa->id;
            $presensi = $this->presensiModel->where('ip_address', $ip_address)->asObject()->first();
            if (!empty($presensi)) {
                return redirect()->to('/')->with('error', "presensi gagal, ip address sudah digunakan");
            }
            $data = [
                'id_matakuliah' => $id_matakuliah,
                'id_mahasiswa' => $mahasiswa_id,
                'ip_address' => $ip_address,
                'tanggal_presensi' => date('Y-m-d H:i:s'),
                'status' => 1,
            ];
            $this->presensiModel->insert($data);
            return redirect()->to('/')->with('success', "presensi telah berhasil");
        } else {
            return redirect()->to('/')->with('error', "Data mahasiswa tidak ditemukan!");
        }
    }

    public function getHari($hari)
    {
        switch ($hari) {
            case 'Monday':
                $result = 'Senin';
                break;
            case 'Tuesday':
                $result = 'Selasa';
                break;
            case 'Wednesday':
                $result = 'Rabu';
                break;
            case 'Thursday':
                $result = 'Kamis';
                break;
            case 'Friday':
                $result = 'Jum\'at';
                break;
            case 'Saturday':
                $result = 'Sabtu';
                break;
            case 'Sunday':
                $result = 'Minggu';
                break;

            default:
                # code...
                break;
        }

        return $result;
    }

    public function getHariEnglish($hari)
    {
        switch ($hari) {
            case 'Senin':
                $result = 'Monday';
                break;
            case 'Selasa':
                $result = 'Tuesday';
                break;
            case 'Rabu':
                $result = 'Wednesday';
                break;
            case 'Kamis':
                $result = 'Thursday';
                break;
            case 'Jumat':
                $result = 'Friday';
                break;
            case 'Sabtu':
                $result = 'Saturday';
                break;
            case 'Minggu':
                $result = 'Sunday';
                break;

            default:
                # code...
                break;
        }

        return $result;
    }
}
