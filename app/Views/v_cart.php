<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
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
            z-index: 1000;
            /* Make sure footer is on top */
        }

        .footer-btn {
            width: 100%;
        }

        /* Fullscreen dropdown */
        #checkout-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black background */
            z-index: 999;
            /* Ensure form is on top of other content */
        }

        #checkout-form .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
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
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle footer-btn" type="button" id="dropdownCheckout" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Checkout
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownCheckout" id="checkout-form">
                    <div class="container">
                        <form action="<?= site_url('cart/checkout') ?>" method="post" class="px-4 py-3">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                            <h4>Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.') ?></h4>
                            <button type="submit" class="btn btn-success">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
            <h4>Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.') ?></h4>
        </div>
    </footer>

    <!-- Script to toggle checkout form -->
    <script>
        $(document).ready(function() {
            // Toggle the visibility of checkout form when dropdown button is clicked
            $('#dropdownCheckout').on('click', function() {
                $('#checkout-form').toggle();
            });
        });
    </script>
</body>

</html>
