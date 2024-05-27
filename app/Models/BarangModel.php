<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $allowedFields = [
        'kode_barang', 'nama_barang', 'jumlah', 'harga', 'berat', 'gambar', 'total_ongkir', 'created_at', 'updated_at', 'deleted_at'
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
}
