<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_barang', 'jumlah', 'harga', 'nama_barang'];

    public function addToCart($kode_barang, $jumlah, $harga, $nama_barang)
    {
        // Check if the item already exists in the cart
        $existingItem = $this->where('kode_barang', $kode_barang)->first();

        if ($existingItem) {
            // Update the quantity of the existing item
            $existingItem['jumlah'] += $jumlah;
            $this->update($existingItem['id'], $existingItem);
        } else {
            // Add a new item to the cart
            $this->insert([
                'kode_barang' => $kode_barang,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'nama_barang' => $nama_barang
            ]);
        }
    }

    public function removeFromCart($id)
    {
        $this->delete($id);
    }

    public function getCartItems()
    {
        return $this->findAll();
    }
}
