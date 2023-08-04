<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class pembeli extends BaseController
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
                            <h1 class="m-0">pembeli</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">pembeli</a></li>
                            <li class="breadcrumb-item active">pembeli</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumn'] = $breadcrumb;
        return view('pembeli/content', $data);
    }
}
