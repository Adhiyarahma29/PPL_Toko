<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Your Shop</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Keranjang Belanja</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Loop untuk menampilkan barang yang ada di keranjang -->
                        <?php foreach ($cartItems as $item) : ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title"><?= $item['name'] ?></h5>
                                    <p class="card-text">Harga: Rp <?= number_format($item['price'], 2, ',', '.') ?></p>
                                    <p class="card-text">Jumlah: <?= $item['quantity'] ?></p>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan Belanja</h5>
                        <p class="card-text">Total Barang: <?= $totalItems ?></p>
                        <p class="card-text">Total Harga: Rp <?= number_format($totalPrice, 2, ',', '.') ?></p>
                        <a href="#" class="btn btn-primary btn-block">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>