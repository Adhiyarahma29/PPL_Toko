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
                    'berat' => $barang['berat'],
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
        $data['totalHarga'] = 0;
        $data['totalBerat'] = 0;

        foreach ($data['cart'] as $item) {
            $data['totalHarga'] += $item['jumlah'] * $item['harga'];
            $data['totalBerat'] += $item['jumlah'] * $item['berat'];
        }

        // Minimal berat untuk ongkir adalah 1 kg dengan ongkir Rp 3000
        if ($data['totalBerat'] > 0) {
            $data['totalOngkir'] = max($data['totalBerat'], 1) * 3000;
        } else {
            $data['totalOngkir'] = 0;
        }

        $data['totalHarga'] += $data['totalOngkir']; // Tambahkan ongkir ke total harga

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

        // Calculate total weight
        $totalBerat = 0;
        foreach ($cart as $item) {
            $totalBerat += $item['jumlah'] * $item['berat'];
        }

        // Calculate shipping cost
        $ongkir = $totalBerat * 3000;

        // Calculate final total price
        $finalTotalHarga = $totalHarga + $ongkir;

        // Prepare data for insertion
        $jualModel = new JualModel();
        $data = [
            'id_transaksi' => uniqid('TRX'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'nama_barang' => json_encode($cart), // Store cart items as JSON
            'total_harga' => $finalTotalHarga,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Save order to database
        $jualModel->insert($data);

        // Clear the cart
        session()->remove('cart');

        return redirect()->to('/cart')->with('success', 'Pembelian berhasil dilakukan.');
    }
}
