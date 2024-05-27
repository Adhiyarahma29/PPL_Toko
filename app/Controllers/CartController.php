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
        $jualModel = new JualModel();
        $cart = session()->get('cart');

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Keranjang Anda kosong.');
        }

        $nama   = $this->request->getPost('nama');
        $email  = $this->request->getPost('email');
        $alamat = $this->request->getPost('alamat');
        $totalHarga = array_sum(array_map(function ($item) {
            return $item['harga'] * $item['jumlah'];
        }, $cart));

        $lastTransaction = $jualModel->orderBy('id_transaksi', 'DESC')->first();
        $newId = $lastTransaction ? 'TR' . str_pad((int)substr($lastTransaction['id_transaksi'], 2) + 1, 3, '0', STR_PAD_LEFT) : 'TR001';

        $data = [
            'id_transaksi' => $newId,
            'nama'         => $nama,
            'email'        => $email,
            'alamat'       => $alamat,
            'total_harga'  => $totalHarga,
        ];

        if ($jualModel->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $jualModel->errors());
        }

        session()->remove('cart');
        return redirect()->to('/')->with('message', 'Checkout berhasil!');
    }
}
