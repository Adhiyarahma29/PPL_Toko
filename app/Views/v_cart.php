<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        .cart-item-card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1 class="text-center mt-3">Keranjang Belanja</h1>
    <div class="container">
        <?php
        $totalHarga = 0; // Inisialisasi total harga
        foreach ($cart as $item) :
            $subtotal = $item['jumlah'] * $item['harga'];
            $totalHarga += $subtotal; // Hitung total harga
        ?>
            <div class="card cart-item-card">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                    <p class="card-text">Jumlah: <?= $item['jumlah'] ?></p>
                    <p class="card-text">Harga: Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                    <p class="card-text">Subtotal: Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
                    <a href="<?= site_url('cart/remove/' . $item['kode_barang']) ?>">HAPUS</a>
                </div>
            </div>

        <?php endforeach; ?>

        <!-- Tampilkan total harga di sini -->
        <div class="text-right">
            <h4>Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.') ?></h4>
        </div>
    </div>
    <button><a href="<?= site_url('cart/remove/') ?>">HAPUS</a></button>
    <!-- Add your checkout button and other elements here -->
</body>

</html>