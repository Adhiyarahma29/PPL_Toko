<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
                'unique'     => true,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT', // Use TEXT for longer descriptions
                'null' => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'berat' => [ // Menambahkan kolom berat
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'total_ongkir' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Add a primary key
        $this->forge->addKey('kode_barang', true);

        // Create the table
        $this->forge->createTable('barang');
    }

    public function down()
    {
        // Drop the 'barang' table
        $this->forge->dropTable('barang');
    }
}
