<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
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
            padding-top: 0.5rem; /* Mengurangi padding atas */
            padding-bottom: 0.25rem; /* Mengurangi padding bawah */
            height: 80px; /* Menetapkan tinggi navbar */
            display: flex; /* Menggunakan flexbox */
            justify-content: center; /* Memusatkan elemen horizontal di dalam header */
            align-items: flex-end; /* Memusatkan elemen vertikal di dalam header */
        }

        .navbar-brand {
            font-size: 1.80rem; /* Mengurangi ukuran font untuk navbar-brand */
            margin-right: auto; /* Menggeser tulisan "Your Shop" ke kiri */
            margin-left: auto; /* Menggeser tulisan "Your Shop" ke kanan */
        }

        .navbar-nav .nav-link {
            font-size: 1.30rem; /* Mengurangi ukuran font untuk navbar-nav */
        }


        .card {
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s, box-shadow 0.5s;
        }

        .card:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card .card-body {
            position: relative;
            transition: transform 0.5s;
            transform-origin: bottom;
        }

        .card:hover .card-body {
            transform: rotateX(-10deg) translateY(-10px);
        }

        .card .card-body:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            transform: translateY(100%) rotateX(90deg);
            transition: transform 0.5s;
        }

        .card:hover .card-body:before {
            transform: translateY(0) rotateX(0);
        }

        .card .card-img-top {
            transition: transform 0.5s;
        }

        .card:hover .card-img-top {
            transform: scale(1.1) rotateY(5deg);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #777;
        }

        .price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
        }

        .container {
            margin-top: 50px;
        }

        .btn {
            margin-top: 20px;
            width: 100%;
            background-color: #3282b8;
            border: none;
        }

        .btn:hover {
            background-color: #0f4c75;
        }

        .large-icon {
            font-size: 2rem;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-sm">
        <div class="container">
            <a class="navbar-brand" href="/">Daftar Produk</a>
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


    <!-- Product List -->
    <div class="container">
    <!-- <h1 class="mt-5 text-center text-white">Daftar Produk</h1> -->
    <div class="row">
        <?php if (!empty($products) && is_array($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="col-md-3 mb-4">
                    <a href="<?= base_url('detail/' . esc($product['kode_barang'])) ?>" class="text-decoration-none">
                        <div class="card">
                            <img src="<?= esc($product['gambar']) ?>" class="card-img-top" alt="<?= esc($product['nama_barang']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($product['nama_barang']) ?></h5>
                                <p class="card-text"><?= esc($product['deskripsi']) ?></p>
                                <p class="card-text"><span class="price">Rp <?= number_format($product['harga'], 2, ',', '.') ?></span></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center text-white">Tidak ada produk yang ditemukan.</p>
        <?php endif; ?>
    </div>
</div>



    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <p>&copy; 2024 Your Shop. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>