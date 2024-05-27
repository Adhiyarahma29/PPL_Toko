<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\JualModel;

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

        return redirect()->to('/cart');
    }


    public function checkout()
    {
        $cart = session()->get('cart') ?? [];

        // Calculate total price
        $totalHarga = 0;
        foreach ($cart as $item) {
            $subtotal = $item['jumlah'] * $item['harga'];
            $totalHarga += $subtotal;
        }

        // Get form data
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $alamat = $this->request->getPost('alamat');

        // Get nama barang
        $barangModel = new BarangModel();
        $namaBarang = [];
        foreach ($cart as $item) {
            $barang = $barangModel->find($item['kode_barang']);
            if ($barang) {
                $namaBarang[] = $barang['nama_barang'];
            }
        }

        // Get next id_transaksi
        $jualModel = new JualModel();
        $next_id = $jualModel->countAllResults() + 1;

        // Generate id_transaksi
        $id_transaksi = 'TR' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

        // Insert data into 'jual' table
        $jualModel->insert([
            'id_transaksi' => $id_transaksi,
            'nama' => $nama,
            'email' => $email,
            'alamat' => $alamat,
            'nama_barang' => $namaBarang, // Store array of barang names as JSON string
            'total_harga' => $totalHarga
        ]);

        // Clear cart after checkout
        session()->remove('cart');

        return redirect()->to('/cart');
    }
}
