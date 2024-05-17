<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run()
    {
        // Array untuk menyimpan data barang
        $data = [];
        $imagePath = 'image/';


        // Looping untuk membuat 30 data contoh
        for ($i = 1; $i <= 6; $i++) {
            // Kode barang unik (B001, B002, B003, ...)
            $kode = 'B' . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Data barang untuk setiap iterasi
            $barang = [
                'kode_barang' => $kode, // Kode barang unik
                'nama_barang' => 'Susu Ultra Putih 250 Ml ', // Nama barang dengan nomor iterasi
                'harga' => 1000 * $i, // Harga contoh (dapat Anda atur sesuai keinginan)
                'jumlah' => rand(10, 50), // Stok acak antara 10 dan 50
                'gambar'      => $imagePath . 'ultra_putih.png',
                'deskripsi' => 'Susu Ultra Putih 250 Ml dengan kemasan baru'
            ];

            // Tambahkan data barang ke dalam array
            $data[] = $barang;
        }

        // Masukkan data barang ke dalam tabel 'barang' menggunakan batch insert
        $this->db->table('barang')->insertBatch($data);
    }
}
