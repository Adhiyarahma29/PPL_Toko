<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use CodeIgniter\Controller;

class CartController extends Controller
{
    public function addToCart()
    {
        // Ambil data dari form
        $kodeBarang = $this->request->getPost('kode_barang');
        $quantity = $this->request->getPost('quantity');


        // Ambil data barang dari database
        $barangModel = new BarangModel();
        $barang = $barangModel->find($kodeBarang);

        // Jika barang tidak ditemukan, kembali ke halaman sebelumnya
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Tambahkan barang ke dalam keranjang
        $cart = session()->get('cart') ?? [];
        $cart[$kodeBarang] = [
            'nama_barang' => $barang['nama_barang'],
            'harga' => $barang['harga'],
            'jumlah' => $quantity
        ];
        session()->set('cart', $cart);

        // Redirect ke halaman keranjang
        return redirect()->to('/cart')->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function viewCart()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart');

        // Load view dan kirim data keranjang
        return view('v_cart', ['cart' => $cart]);
    }
}
