<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = [
            [
                'id' => 1,
                'nama' => 'Toyota Avanza',
                'plat' => 'KT 1234 WB',
                'kapasitas' => '7 Orang',
                'status' => 'Tersedia',
                'driver' => 'Pak Joko',
                'bahan_bakar' => 'Bensin (Full)',
            ],
            [
                'id' => 2,
                'nama' => 'Mitsubishi Pajero Sport',
                'plat' => 'KT 8888 KK',
                'kapasitas' => '7 Orang',
                'status' => 'Dipakai',
                'driver' => 'Darman',
                'bahan_bakar' => 'Solar (50%)',
            ],
            [
                'id' => 3,
                'nama' => 'Toyota Innova Zenix',
                'plat' => 'KT 5678 AB',
                'kapasitas' => '7 Orang',
                'status' => 'Tersedia',
                'driver' => 'Pak Budi',
                'bahan_bakar' => 'Hybrid (Full)',
            ],
        ];

        return view('ketersediaan.index', compact('cars'));
    }
}