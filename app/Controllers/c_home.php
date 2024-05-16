<?php

// app/Controllers/Product.php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;

class c_home extends Controller
{
    public function index()
    {
        // Load the model
        $barangModel = new BarangModel();

        // Fetch all products from the database
        $data['products'] = $barangModel->getDataBarang();

        // Pass the data to the view
        return view('v_home', $data);
    }

    public function detail($kode_barang)
    {
        // Load the model
        $barangModel = new BarangModel();

        // Fetch all products from the database
        $data['product'] = $barangModel->getDataBarangByKode($kode_barang);

        return view('v_detail_barang', $data);
    }
}
