<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;

class karyawan extends BaseController
{
    protected $am;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->am = new KaryawanModel();

        $this->menu =[
                'beranda' => [
                    'title'=> 'Beranda',
                    'link' => base_url(),
                    'icon' => 'fa-solid fa-house',
                    'aktif'=> 'active',
                ],
                'karyawan' => [
                    'title'=> 'karyawan',
                    'link' => base_url() . '/karyawan',
                    'icon' => 'fa-solid fa-users',
                    'aktif'=> '',
                ],
                'pembeli' => [
                    'title' => 'pembeli',
                    'link' => base_url() . '/pembeli',
                    'icon' => 'fa-solid fa-person',
                    'aktif'=>'',
                ],
            ];

        $this->rules = [
            'idkaryawan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id karyawan tidak boleh kosong',
                ]
            ],
            'namakaryawan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama karyawan tidak boleh kosong',
                ]
            ],
            'pembeli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pembeli tidak boleh kosong',
                ]
            ],
        ];
    }

    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">karyawan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumn'] = $breadcrumb;
        $data['title_card'] = "Data karyawan";

        $query = $this->am->find();
        $data ['data_karyawan'] = $query;
        return view('karyawan/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/karyawan">karyawan</a></li>
                                <li class="breadcrumb-item active">Tambah Karyawan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Karyawan';
        $data['action'] = base_url() . '/karyawan/simpan';
        return view('karyawan/input', $data);
    }

    public function simpan()
    {
        
        if (! $this->request->is('post')) {
            
            return redirect()->back()->withInput();
        }

        if (! $this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();
        try {
            $simpan = $this->am->insert($dt);
            return redirect()->to('karyawan')->with('success', 'Data berhasil disimpan');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }    
    }

    public function hapus($id) 
    {
        if(empty($id)) {
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }

        try {
            $this->am->delete($id);
            return redirect()->to('karyawan')->with('success', 'Data karyawan dengan kode '.$id.'berhasil dihapus');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            return redirect()->to('karyawan')->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/karyawan">karyawan</a></li>
                                <li class="breadcrumb-item active">Edit karyawan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit karyawan';
        $data['action'] = base_url() . '/karyawan/update';

        $data['edit_data'] =$this->am->find($id);
        return view('karyawan/input', $data);
    }

    public function update() {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);

        if (!$this->validate($this->rules)) {

            return redirect()->back()->withinput();
        }

        if (empty($dtEdit['password'])) {
            unset($dtEdit['password']);
        }

        try {
            $this->am->update($param, $dtEdit);
            return redirect()->to('karyawan')->with('success', 'Data berhasil di Update');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirec()->back()->withInput();
        }
    }
}
