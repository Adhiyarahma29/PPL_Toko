<?php

namespace App\Models;

use CodeIgniter\Model;

class JualModel extends Model
{
    protected $table = 'jual';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_transaksi', 'nama', 'email', 'alamat', 'total_harga'];

    // Optional: You can define validation rules for the fields
    protected $validationRules = [
        'id_transaksi' => 'required|alpha_numeric|min_length[3]|max_length[5]',
        'nama'         => 'required|alpha_space|min_length[3]|max_length[50]',
        'email'        => 'required|valid_email|max_length[100]',
        'alamat'       => 'required|min_length[10]|max_length[255]',
        'total_harga'  => 'required|decimal',
    ];
}
