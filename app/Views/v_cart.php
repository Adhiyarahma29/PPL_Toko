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
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .cart-item-card {
            margin-bottom: 20px;
        }

        footer {
            background-color: #343a40;
            padding: 10px 0;
        }

        .footer-btn {
            width: 100%;
        }

        #checkout-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
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
    <div class="wrapper">
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

        <div class="container content mb-5">
            <h1 class="mt-4">Keranjang Belanja</h1>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (!empty($cart)) : ?>
                <div class="row">
                    <?php foreach ($cart as $item) : ?>
                        <div class="col-md-4 cart-item-card">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                                    <p class="card-text">Jumlah: <?= $item['jumlah'] ?></p>
                                    <p class="card-text">Harga: Rp<?= number_format($item['harga'], 0, ',', '.') ?></p>
                                    <p class="card-text">Berat: <?= $item['berat'] ?> kg</p>
                                    <a href="/cart/remove/<?= $item['kode_barang'] ?>" class="btn btn-danger mt-auto">Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3>Total Berat: <?= $totalBerat ?> kg</h3>
                                <h3>Ongkos Kirim: Rp<?= number_format($totalOngkir, 0, ',', '.') ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-info mt-4">Keranjang belanja Anda kosong.</div>
            <?php endif; ?>
        </div>

        <footer class="bg-dark text-white">
            <div class="container">
                <div class="column">
                    <div class="col text-center">
                        <button class="btn btn-success footer-btn" onclick="showCheckoutForm()">Checkout</button>
                    </div>
                    <div>
                        <center>
                            <h3>Total Bayar: Rp<?= number_format($totalHarga, 0, ',', '.') ?></h3>
                        </center>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div id="checkout-form">
        <div class="container">
            <h2>Checkout Form</h2>
            <form action="/cart/checkout" method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="hideCheckoutForm()">Cancel</button>
            </form>
            <h3>Total Bayar: Rp<?= number_format($totalHarga, 0, ',', '.') ?></h3>
        </div>
    </div>

    <script>
        function showCheckoutForm() {
            document.getElementById('checkout-form').style.display = 'block';
        }

        function hideCheckoutForm() {
            document.getElementById('checkout-form').style.display = 'none';
        }
    </script>
</body>

</html>