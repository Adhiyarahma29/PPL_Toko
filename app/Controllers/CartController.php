<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use CodeIgniter\Controller;

class CartController extends Controller
{
    protected $barangModel;
    protected $cartModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->cartModel = new CartModel();
    }

    public function addToCart($kode_barang)
    {
        $jumlah = $this->request->getPost('jumlah');

        // Get data barang by kode_barang
        $barang = $this->barangModel->getDataBarangByKode($kode_barang);

        if ($barang) {
            // Add to cart with necessary data
            $this->cartModel->addToCart($kode_barang, $jumlah, $barang['harga'], $barang['nama_barang']);

            // Redirect to cart page
            return redirect()->to(site_url('cart'));
        } else {
        }
    }

    public function index()
    {
        $cartItems = $this->cartModel->getCartItems();
        $data = ['cartItems' => $cartItems];
        return view('v_cart', $data);
    }

    public function checkout()
    {
        // Implement your checkout logic here
    }
}
