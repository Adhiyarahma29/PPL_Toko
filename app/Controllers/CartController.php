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
        // Misalkan Anda ingin menyimpan data barang ke dalam session keranjang
        $cart = session()->get('cart') ?? [];


        // Jika barang sudah ada dalam keranjang, tambahkan jumlahnya
        if (array_key_exists($kode_barang, $cart)) {
            $cart[$kode_barang]['jumlah'] += 1;
        } else {
            // Jika barang belum ada dalam keranjang, tambahkan sebagai item baru
            $barang = $barangModel->getDataBarangByKode($kode_barang);
            if ($barang) {
                $cart[$kode_barang] = [
                    'kode_barang' => $kode_barang,
                    'nama_barang' => $barang['nama_barang'],
                    'harga' => $barang['harga'],
                    'jumlah' => isset($cart[$kode_barang]) ? $cart[$kode_barang]['jumlah'] + 1 : 1
                ];
            }
        }

        // Simpan kembali keranjang ke dalam session
        session()->set('cart', $cart);

        return redirect()->to('cart');
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

        return redirect()->to('cart');
    }
}
