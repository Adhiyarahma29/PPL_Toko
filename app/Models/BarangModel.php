<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $allowedFields = [
        'kode_barang', 'nama_barang', 'jumlah', 'harga', 'gambar', 'created_at', 'updated_at', 'deleted_at'
    ];

    // Define return type
    protected $returnType = 'array';

    // Automatically handle timestamps
    protected $useTimestamps = true;

    // If you use soft deletes
    protected $useSoftDeletes = true;

    public function getDataBarang()
    {
        $query = "SELECT * FROM barang";
        $result = $this->db->query($query);
        return $result->getResultArray();
    }

    public function getDataBarangByKode($kode)
    {
        $query = "SELECT * FROM barang WHERE kode_barang = ?";
        $result = $this->db->query($query, [$kode]);
        return $result->getRowArray();
    }

    public function addToCart($kode_barang, $jumlah)
    {
        // Misalkan Anda ingin menyimpan data barang ke dalam session keranjang
        $cart = session()->get('cart') ?? [];

        // Jika barang sudah ada dalam keranjang, tambahkan jumlahnya
        if (array_key_exists($kode_barang, $cart)) {
            $cart[$kode_barang]['jumlah'] += $jumlah;
        } else {
            // Jika barang belum ada dalam keranjang, tambahkan sebagai item baru
            $barang = $this->getDataBarangByKode($kode_barang);
            if ($barang) {
                $cart[$kode_barang] = [
                    'kode_barang' => $kode_barang,
                    'nama_barang' => $barang['nama_barang'],
                    'harga' => $barang['harga'],
                    'jumlah' => $jumlah
                ];
            }
        }

        // Simpan kembali keranjang ke dalam session
        session()->set('cart', $cart);
    }

    public function getCartItems()
    {
        return session()->get('cart') ?? [];
    }
}
