<?php

// app/Controllers/Product.php
namespace App\Controllers;

use CodeIgniter\Controller;

class c_home extends Controller
{
    public function index()
    {
        // Data produk contoh
        $data['products'] = [
            [
                'name' => 'Produk 1',
                'description' => 'Deskripsi produk 1',
                'price' => 100000,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Produk 2',
                'description' => 'Deskripsi produk 2',
                'price' => 200000,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Produk 3',
                'description' => 'Deskripsi produk 3',
                'price' => 300000,
                'image' => 'https://via.placeholder.com/150'
            ],
        ];
        
        return view('v_home', $data);
    }
}
