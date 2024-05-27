<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = ['kode_barang', 'id_transaksi']; // Define composite primary key
    protected $allowedFields = ['kode_barang', 'id_transaksi', 'nama_barang', 'jumlah', 'harga', 'created_at', 'updated_at', 'deleted_at'];
    protected $useTimestamps = true; // Automatically fill 'created_at' and 'updated_at' fields
    protected $useSoftDeletes = true; // Enable soft deletes

    protected $returnType = 'object'; // Set the default return type to object

    // Define validation rules
    protected $validationRules = [
        'kode_barang' => 'required|max_length[4]',
        'id_transaksi' => 'required|max_length[5]',
        'nama_barang' => 'required|max_length[100]',
        'jumlah' => 'required|integer',
        'harga' => 'required|decimal',
    ];

    // Define validation error messages
    protected $validationMessages = [
        'kode_barang' => [
            'required' => 'Kode barang harus diisi.',
            'max_length' => 'Kode barang maksimal 4 karakter.'
        ],
        'id_transaksi' => [
            'required' => 'ID transaksi harus diisi.',
            'max_length' => 'ID transaksi maksimal 5 karakter.'
        ],
        'nama_barang' => [
            'required' => 'Nama barang harus diisi.',
            'max_length' => 'Nama barang maksimal 100 karakter.'
        ],
        'jumlah' => [
            'required' => 'Jumlah harus diisi.',
            'integer' => 'Jumlah harus berupa bilangan bulat.'
        ],
        'harga' => [
            'required' => 'Harga harus diisi.',
            'decimal' => 'Harga harus berupa angka desimal.'
        ],
    ];

    // Set validation scenario
    protected $validationScenarios = [
        'insert' => ['kode_barang', 'id_transaksi', 'nama_barang', 'jumlah', 'harga'],
        'update' => ['kode_barang', 'id_transaksi', 'nama_barang', 'jumlah', 'harga'],
    ];

    // Define timestamps fields format
    protected $dateFormat = 'datetime';

    // Soft deletes fields
    protected $deletedField = 'deleted_at';

    // Automatically fill 'updated_at' field
    protected $updatedField = 'updated_at';
}
