<?php

namespace App\Models;

use CodeIgniter\Model;

class JualModel extends Model
{
    protected $table = 'jual';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_transaksi', 'nama', 'email', 'alamat', 'nama_barang', 'total_harga', 'created_at', 'updated_at', 'deleted_at'
    ];
    // Optional: You can define validation rules for the fields
    protected $validationRules = [
        'id_transaksi' => 'required|alpha_numeric|min_length[3]|max_length[15]',
        'nama'         => 'required|min_length[3]|max_length[100]',
        'email'        => 'required|valid_email|max_length[100]',
        'alamat'       => 'required|min_length[10]|max_length[255]',
        'total_harga'  => 'required|decimal',
        'nama_barang'  => 'required', // Add validation rule for nama_barang
    ];
}
