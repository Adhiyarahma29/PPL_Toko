<!DOCTYPE html>
<html lang="en">

<head>
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    <div class="container">
        <h1 class="mt-5 text-center">Detail Produk</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <img src="<?= base_url($product['gambar']) ?>" class="card-img-top product-img" alt="<?= esc($product['nama_barang']) ?>">
                    <div class="card-body product-details">
                        <h5 class="product-title"><?= esc($product['nama_barang']) ?></h5>
                        <p class="product-description">Deskripsi: <?= esc($product['deskripsi']) ?></p>
                        <p class="price">Rp <?= number_format($product['harga'], 2, ',', '.') ?></p>
                        <form action="<?= site_url('cart/addToCart/' . $product['kode_barang']) ?>" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Jumlah</span>
                                </div>
                                <input type="number" class="form-control" name="jumlah" aria-label="Jumlah" min="1" value="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="buy_now">Beli Sekarang</button>
                            <button type="submit" class="btn btn-outline-success btn-cart" name="add_to_cart"><i class="bi bi-cart"></i> Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>