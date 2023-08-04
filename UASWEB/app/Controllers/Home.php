<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu =[
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

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumn'] = $breadcrumb;
        $data['title_card'] = "Welcome to";
        $data['Selamat_datang'] = "Selamat Datang di Aplikasi Apotek Ibrahimy";
        return view('template/content', $data);
    }
}
