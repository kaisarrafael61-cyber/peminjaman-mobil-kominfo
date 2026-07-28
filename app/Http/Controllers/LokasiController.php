<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        // Data dummy mobil dengan koordinat peta
        $mobilDinas = [
            (object) [
                'nama_mobil' => 'Toyota Avanza',
                'plat_nomor' => 'KT 1234 WB',
                'dibawa_oleh'=> 'Pak Joko',
                'latitude'   => '-0.502106',
                'longitude'  => '117.153709',
            ],
            (object) [
                'nama_mobil' => 'Mitsubishi Pajero Sport',
                'plat_nomor' => 'KT 8888 KK',
                'dibawa_oleh'=> 'Darman',
                'latitude'   => '-0.503200',
                'longitude'  => '117.154800',
            ],
            (object) [
                'nama_mobil' => 'Toyota Innova Zenix',
                'plat_nomor' => 'KT 5678 AB',
                'dibawa_oleh'=> 'Pak Budi',
                'latitude'   => '-0.504100',
                'longitude'  => '117.155900',
            ],
        ];

        return view('lokasi.index', compact('mobilDinas'));
    }
}