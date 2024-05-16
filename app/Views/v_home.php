<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            text-align: center;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            color: #555;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 text-center">Daftar Produk</h1>
        <div class="row">
            <?php if (!empty($products) && is_array($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?= esc($product['image']) ?>" class="card-img-top" alt="<?= esc($product['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($product['name']) ?></h5>
                                <p class="card-text"><?= esc($product['description']) ?></p>
                                <p class="price">Rp <?= number_format($product['price'], 2, ',', '.') ?></p>
                                <a href="#" class="btn btn-primary">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Tidak ada produk yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
