<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabelPenjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
            ],
            'id_transaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
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

        // Add primary key as combination of kode_barang and id_transaksi
        $this->forge->addPrimaryKey(['kode_barang', 'id_transaksi']);

        // Add foreign key to 'barang'
        $this->forge->addForeignKey('kode_barang', 'barang', 'kode_barang');

        // Add foreign key to 'jual'
        $this->forge->addForeignKey('id_transaksi', 'jual', 'id_transaksi');

        // Create the table
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        // Drop the 'penjualan' table
        $this->forge->dropTable('penjualan');
    }
}
