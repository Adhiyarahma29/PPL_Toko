<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .cart-item-card {
            margin-bottom: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            padding: 10px 0;
        }

        .footer-btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Your Shop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/cart"><i class="bi bi-cart large-icon"></i> Keranjang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h1 class="text-center mt-3">Keranjang Belanja</h1>
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
                    <a href="<?= site_url('cart/remove/' . $item['kode_barang']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <footer class="bg-dark text-white text-center">
        <div class="container">
            <h4>Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.') ?></h4>
            <a href="<?= site_url('cart/checkout') ?>" class="btn btn-success footer-btn">Checkout</a>
        </div>
    </footer>

</body>

</html>