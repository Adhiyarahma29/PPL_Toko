<?php

namespace App\Controllers;

use App\Models\BarangModel;

use CodeIgniter\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        session();
    }

    public function addToCart($kode_barang)
    {
        $barangModel = new BarangModel();
        $cart = session()->get('cart') ?? [];
        $jumlah = $this->request->getPost('jumlah') ?? 1;

        if (array_key_exists($kode_barang, $cart)) {
            $cart[$kode_barang]['jumlah'] += $jumlah;
        } else {
            $barang = $barangModel->getDataBarangByKode($kode_barang);
            if ($barang) {
                $cart[$kode_barang] = [
                    'kode_barang' => $kode_barang,
                    'nama_barang' => $barang['nama_barang'],
                    'harga' => $barang['harga'],
                    'jumlah' => $jumlah
                ];
            }
        }

        session()->set('cart', $cart);

        return redirect()->to('/cart');
    }

    public function lookCart()
    {
        $data['cart'] = session()->get('cart') ?? [];

        return view('v_cart', $data);
    }

    public function removeFromCart($kode_barang)
    {
        $cart = session()->get('cart') ?? [];

        unset($cart[$kode_barang]);

        session()->set('cart', $cart);

        return redirect()->to('/cart');
    }

    public function checkout()
    {
        $data['cart'] = session()->get('cart') ?? [];

        return view('v_checkout', $data);
    }
}
