<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\JualModel;
use App\Models\PenjualanModel;
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

        // Calculate shipping cost based on actual total weight
        // Minimal berat untuk ongkir adalah 1 kg dengan ongkir Rp 3000
        $data['totalOngkir'] = $data['totalBerat'] > 0 ? $data['totalBerat'] * 3000 : 0;

        // Tambahkan ongkir ke total harga
        $data['totalHarga'] += $data['totalOngkir'];

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

        // Calculate total weight
        $totalBerat = 0;
        foreach ($cart as $item) {
            $totalBerat += $item['jumlah'] * $item['berat'];
        }

        // Round up total weight to the nearest whole kilogram
        // Calculate shipping cost directly based on actual weight
        $ongkir = $totalBerat * 3000;

        // Calculate final total price
        $finalTotalHarga = $totalHarga + $ongkir;

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
            'total_harga' => $finalTotalHarga,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Reduce stock quantity
        foreach ($cart as $item) {
            $barangModel->set('jumlah', 'jumlah - ' . $item['jumlah'], false)
                ->where('kode_barang', $item['kode_barang'])
                ->update();
        }

        // Insert data into 'penjualan' table
        $penjualanModel = new PenjualanModel();
        foreach ($cart as $item) {
            $penjualanModel->insert([
                'kode_barang' => $item['kode_barang'],
                'id_transaksi' => $id_transaksi,
                'nama_barang' => $item['nama_barang'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        // Clear cart after checkout
        session()->remove('cart');

        return redirect()->to('/cart')->with('success', 'Pembelian berhasil dilakukan.');
    }
}
