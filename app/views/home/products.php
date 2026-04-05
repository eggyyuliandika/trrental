<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - TR Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary: #5B2D8E; --primary-light: #7B4DB8; --primary-bg: #EAE4F3; }
        * { font-family: 'Segoe UI', sans-serif; }
        body { background: #fff; overflow-x: hidden; }

        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,.08); padding: 12px 0; }
        .navbar-brand img { height: 45px; }
        .nav-link { color: #333 !important; font-weight: 500; }
        .btn-nav-active {
            background: var(--primary); color: #fff !important;
            border-radius: 25px; padding: 8px 24px !important;
        }

        /* Hero Products */
        .hero-products {
            background: #fff;
            padding: 60px 0 30px;
            position: relative;
            overflow: hidden;
        }
        .hero-products::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            background: var(--primary-bg);
            border-radius: 50%;
        }
        .hero-products h1 { font-weight: 800; font-size: 2.5rem; }

        /* Search */
        .search-wrapper {
            position: relative;
            max-width: 500px;
            margin: 30px auto;
        }
        .search-wrapper input {
            border-radius: 25px;
            border: 1px solid #ddd;
            padding: 12px 20px 12px 45px;
            width: 100%;
            font-size: 1rem;
            outline: none;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }
        .search-wrapper i {
            position: absolute;
            right: 18px; top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        /* Category Tabs */
        .category-section { padding: 30px 0 60px; }
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .btn-category {
            background: var(--primary);
            color: #fff;
            border-radius: 25px;
            padding: 8px 24px;
            font-weight: 600;
            border: none;
        }
        .see-all {
            color: #333;
            font-weight: 500;
            text-decoration: none;
        }
        .see-all:hover { color: var(--primary); }

        /* Vehicle Card */
        .vehicle-card {
            border: 2px solid #eee;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            transition: all .25s;
            background: #fff;
            margin-bottom: 20px;
        }
        .vehicle-card:hover {
            border-color: var(--primary);
            box-shadow: 0 6px 20px rgba(91,45,142,.15);
            transform: translateY(-4px);
        }
        .vehicle-card.active { border-color: var(--primary); }
        .vehicle-img-wrap {
            background: #f8f8f8;
            padding: 20px;
            text-align: center;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .vehicle-img-wrap img {
            max-height: 120px;
            max-width: 100%;
            object-fit: contain;
        }
        .vehicle-img-wrap .no-img {
            font-size: 3rem;
            color: #ccc;
        }
        .vehicle-info { padding: 14px 16px; }
        .vehicle-info h6 { font-weight: 700; margin-bottom: 6px; font-size: .95rem; }
        .price-badge {
            background: var(--primary);
            color: #fff;
            border-radius: 20px;
            padding: 4px 14px;
            font-size: .82rem;
            font-weight: 600;
            display: inline-block;
        }

        /* Decoration circle */
        .circle-deco {
            position: absolute;
            background: var(--primary-bg);
            border-radius: 50%;
            z-index: 0;
        }

        footer {
            background: #1a1a1a; color: #aaa;
            padding: 25px 0; text-align: center;
        }
        footer .social-icons a { color: #aaa; margin: 0 8px; font-size: 1.2rem; }
        footer .social-icons a:hover { color: #fff; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <img src="<?= BASE_URL ?>/public/assets/img/logo.png" alt="TR Rental">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/#about">About Us</a></li>
                <li class="nav-item ml-2">
                    <a class="nav-link btn-nav-active" href="#">Products</a>
                </li>
                <li class="nav-item ml-2"><a class="nav-link" href="<?= BASE_URL ?>/#contact">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero-products text-center">
    <div class="container position-relative" style="z-index:1">
        <h1>What We Bring</h1>
        <p class="text-muted">Making it easier to find rides you need, whenever you need them.</p>

        <!-- Search -->
        <div class="search-wrapper">
            <input type="text" id="searchInput" placeholder="Explore Vehicle">
            <i class="fas fa-search"></i>
        </div>
    </div>
</section>

<!-- Products -->
<section class="category-section">
    <div class="container">

        <!-- Mobil -->
        <?php
        $cars  = array_filter($armada, fn($a) => strtolower($a['tipe_armada']) !== 'motor' && strtolower($a['tipe_armada']) !== 'motorbike');
        $bikes = array_filter($armada, fn($a) => in_array(strtolower($a['tipe_armada']), ['motor', 'motorbike', 'matic', 'manual']));
        // Jika tidak bisa difilter by tipe, tampilkan semua di mobil
        if (empty($cars) && empty($bikes)) $cars = $armada;
        ?>

        <div class="category-header">
            <button class="btn-category"><i class="fas fa-car mr-2"></i>Choose Car</button>
            <a href="#" class="see-all">See All &rsaquo;</a>
        </div>
        <div class="row" id="carList">
            <?php if (empty($cars)): ?>
                <div class="col-12 text-center text-muted py-4">Belum ada armada mobil tersedia.</div>
            <?php else: ?>
                <?php foreach ($cars as $a): ?>
                <div class="col-lg-4 col-md-6 vehicle-item" data-name="<?= strtolower($a['nama_armada']) ?>">
                    <div class="vehicle-card" onclick="window.location='<?= BASE_URL ?>/home/booking/<?= $a['id_armada'] ?>'">
                        <div class="vehicle-img-wrap">
                            <?php if ($a['gambar_armada']): ?>
                                <img src="<?= BASE_URL ?>/public/assets/img/armada/<?= $a['gambar_armada'] ?>"
                                    alt="<?= $a['nama_armada'] ?>">
                            <?php else: ?>
                                <span class="no-img"><i class="fas fa-car"></i></span>
                            <?php endif; ?>
                        </div>
                        <div class="vehicle-info">
                            <h6><?= $a['nama_armada'] ?> - <?= $a['tipe_armada'] ?></h6>
                            <span class="price-badge">Rp. <?= number_format($a['harga_sewa_perhari'], 0, ',', '.') ?>/Day</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Motor -->
        <div class="category-header mt-4">
            <button class="btn-category"><i class="fas fa-motorcycle mr-2"></i>Choose Motorbike</button>
            <a href="#" class="see-all">See All &rsaquo;</a>
        </div>
        <div class="row" id="bikeList">
            <?php if (empty($bikes)): ?>
                <div class="col-12 text-center text-muted py-4">Belum ada armada motor tersedia.</div>
            <?php else: ?>
                <?php foreach ($bikes as $a): ?>
                <div class="col-lg-4 col-md-6 vehicle-item" data-name="<?= strtolower($a['nama_armada']) ?>">
                    <div class="vehicle-card" onclick="window.location='<?= BASE_URL ?>/home/booking/<?= $a['id_armada'] ?>'">
                        <div class="vehicle-img-wrap">
                            <?php if ($a['gambar_armada']): ?>
                                <img src="<?= BASE_URL ?>/public/assets/img/armada/<?= $a['gambar_armada'] ?>"
                                    alt="<?= $a['nama_armada'] ?>">
                            <?php else: ?>
                                <span class="no-img"><i class="fas fa-motorcycle"></i></span>
                            <?php endif; ?>
                        </div>
                        <div class="vehicle-info">
                            <h6><?= $a['nama_armada'] ?> - <?= $a['tipe_armada'] ?></h6>
                            <span class="price-badge">Rp. <?= number_format($a['harga_sewa_perhari'], 0, ',', '.') ?>/Day</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>

<footer>
    <div class="container">
        <div class="social-icons mb-2">
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p class="mb-0 small">Copyright &copy; <?= date('Y') ?> TR Rental</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Search filter
$('#searchInput').on('keyup', function() {
    const q = $(this).val().toLowerCase();
    $('.vehicle-item').each(function() {
        const name = $(this).data('name');
        $(this).toggle(name.includes(q));
    });
});
</script>
</body>
</html>