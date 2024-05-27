<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabelJual extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'unique'     => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'total_harga' => [
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

        // Add a primary key
        $this->forge->addKey('id_transaksi', true);

        // Create the table
        $this->forge->createTable('jual');
    }

    public function down()
    {
        // Drop the 'jual' table
        $this->forge->dropTable('jual');
    }
}
