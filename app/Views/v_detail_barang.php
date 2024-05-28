<!DOCTYPE html>
<html lang="en">

<head>
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* style.css */
        body {
            background: linear-gradient(135deg, #0f4c75, #3282b8, #42a4aa, #ffffff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .navbar {
            padding-top: 0.5rem;
            padding-bottom: 0.25rem;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .navbar-brand {
            font-size: 1.80rem;
            margin-right: auto;
            margin-left: auto;
        }

        .navbar-nav .nav-link {
            font-size: 1.30rem;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.5s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-img {
            width: 100%;
        }

        .product-details {
            padding: 20px;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-description {
            color: #777;
            margin-bottom: 10px;
        }

        .price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn-cart {
            margin-top: 10px;
            width: 100%;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Detail Produk</a>
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
        <!-- <h1 class="mt-5 text-center">Detail Produk</h1> -->
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