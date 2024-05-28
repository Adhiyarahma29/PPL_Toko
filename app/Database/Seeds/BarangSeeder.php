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
        $names = [
            'Susu Ultra Putih 250 Ml',
            'Susu Ultra Coklat 250 Ml',
            'Susu Ultra Stroberi 250 Ml',
            'Susu Ultra Biru 250 Ml',
            'Susu Indomilk Coconut 250 Ml',
            'Susu Indomilk Kacang Hijau 250 Ml',
            'Susu Indomilk Ketan Hitamt 250 Ml',
            'Susu Indomilk Pisang 250 Ml',
            'Susu Indomilk Stroberi 250 Ml'
        ];
        $images = [
            'ultra_putih.png',
            'ultra_coklat.png',
            'ultra_stroberi.png',
            'ultra_biru.jpg',
            'indomilk_coconut.jpg',
            'indomilk_kacanghijau.jpg',
            'indomilk_ketanhitam.jpg',
            'indomilk_pisang.jpg',
            'indomilk_stroberi.jpg'
        ];


       // Looping untuk membuat 20 data contoh
        for ($i = 1; $i <= 20; $i++) {
            // Kode barang unik (B001, B002, B003, ...)
            $kode = 'B' . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Pilih nama dan gambar barang berdasarkan index selang-seling
            $index = ($i - 1) % count($names);

            // Data barang untuk setiap iterasi
            $barang = [
                'kode_barang' => $kode, // Kode barang unik
                'nama_barang' => $names[$index], // Nama barang dengan nomor iterasi
                'harga' => 1000 * $i, // Harga contoh (dapat Anda atur sesuai keinginan)
                'jumlah' => rand(10, 50), // Stok acak antara 10 dan 50
                'berat' => 0.25, // Berat produk dalam kg
                'gambar' => $imagePath . $images[$index],
                'deskripsi' => $names[$index] . ' dengan kemasan baru'
            ];

            // Tambahkan data barang ke dalam array
            $data[] = $barang;
        }


        // Masukkan data barang ke dalam tabel 'barang' menggunakan batch insert
        $this->db->table('barang')->insertBatch($data);
    }
}
