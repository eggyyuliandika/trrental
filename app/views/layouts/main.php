<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'TR Rental' ?> - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #5B2D8E;
            --primary-light: #7B4DB8;
            --primary-bg: #EAE4F3;
            --sidebar-width: 220px;
        }
        * { font-family: 'Segoe UI', sans-serif; }
        body { background: #f4f6fb; margin: 0; }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary);
            z-index: 100;
            display: flex;
            flex-direction: column;
            padding: 0;
            overflow-y: auto;
        }
        .sidebar-logo {
            padding: 24px 20px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }
        .sidebar-logo img { height: 70px; }

        .sidebar-menu {
            flex: 1;
            padding: 20px 0;
            list-style: none;
            margin: 0;
        }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .92rem;
            font-weight: 500;
            transition: all .2s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu li a:hover {
            color: #fff;
            background: rgba(255,255,255,.1);
        }
        .sidebar-menu li a.active {
            color: #fff;
            background: rgba(255,255,255,.15);
            border-left: 3px solid #fff;
        }
        .sidebar-menu li a i { width: 20px; text-align: center; font-size: 1rem; }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,.15);
            margin: 10px 20px;
        }

        .sidebar-bottom {
            padding: 16px 0;
            border-top: 1px solid rgba(255,255,255,.15);
        }
        .sidebar-bottom a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px;
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .92rem;
            transition: all .2s;
        }
        .sidebar-bottom a:hover { color: #fff; background: rgba(255,255,255,.1); }
        .sidebar-bottom a i { width: 20px; text-align: center; }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            padding: 14px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .topbar-search {
            position: relative;
            flex: 1;
            max-width: 400px;
        }
        .topbar-search input {
            width: 100%;
            border: 1.5px solid #eee;
            border-radius: 25px;
            padding: 9px 18px 9px 40px;
            font-size: .88rem;
            outline: none;
            background: #f8f9fc;
            transition: border .2s;
        }
        .topbar-search input:focus { border-color: var(--primary); }
        .topbar-search i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .notif-btn {
            position: relative;
            width: 40px; height: 40px;
            background: #f8f9fc;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #555;
            text-decoration: none;
            border: 1.5px solid #eee;
        }
        .notif-badge {
            position: absolute;
            top: -4px; right: -4px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            width: 18px; height: 18px;
            font-size: .65rem;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-bg);
        }
        .admin-name { font-weight: 600; font-size: .9rem; color: #333; }
        .admin-role { font-size: .75rem; color: #999; }

        /* Page Content */
        .page-content {
            padding: 30px;
            flex: 1;
        }
        .page-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 6px;
        }
        .page-subtitle {
            color: #999;
            font-size: .88rem;
            margin-bottom: 28px;
        }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
            margin-bottom: 20px;
        }

        /* Table */
        .table-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
            margin-bottom: 20px;
        }
        .table thead th {
            font-weight: 700;
            font-size: .82rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #888;
            border-bottom: 2px solid #f0f0f0;
            border-top: none;
            padding: 12px 16px;
        }
        .table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-color: #f5f5f5;
            font-size: .9rem;
            color: #333;
        }
        .table tbody tr:hover { background: #faf8ff; }

        /* Badges */
        .badge-menunggu { background: #FFF3CD; color: #856404; }
        .badge-dikonfirmasi { background: #CCE5FF; color: #004085; }
        .badge-disewa { background: #D4EDDA; color: #155724; }
        .badge-selesai { background: #D1ECF1; color: #0C5460; }
        .badge-dibatalkan { background: #F8D7DA; color: #721C24; }
        .status-badge {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: .78rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn-purple {
            background: var(--primary);
            color: #fff;
            border-radius: 8px;
            border: none;
            padding: 8px 18px;
            font-weight: 600;
            font-size: .85rem;
            transition: all .2s;
        }
        .btn-purple:hover { background: var(--primary-light); color: #fff; }
        .btn-detail {
            background: var(--primary-bg);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: .82rem;
            transition: all .2s;
        }
        .btn-detail:hover { background: var(--primary); color: #fff; }

        /* Breadcrumb */
        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 20px;
            font-size: .85rem;
        }
        .breadcrumb-item a { color: var(--primary); text-decoration: none; }
        .breadcrumb-item.active { color: #999; }
        .breadcrumb-item + .breadcrumb-item::before { color: #ccc; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="<?= BASE_URL ?>/public/assets/img/logo.png" alt="TR Rental">
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="<?= BASE_URL ?>/dashboard" class="<?= ($activePage ?? '') === 'dashboard' ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/armada" class="<?= ($activePage ?? '') === 'armada' ? 'active' : '' ?>">
                <i class="fas fa-car"></i> Data Armada
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/customer" class="<?= ($activePage ?? '') === 'customer' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Data Customer
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/booking" class="<?= ($activePage ?? '') === 'booking' ? 'active' : '' ?>">
                <i class="fas fa-list-alt"></i> Data Booking
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/laporan" class="<?= ($activePage ?? '') === 'laporan' ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Laporan
            </a>
        </li>
    </ul>

    <div class="sidebar-bottom">
        <!-- <hr class="sidebar-divider"> -->
        <a href="<?= BASE_URL ?>/auth/logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<!-- Main -->
<div class="main-wrapper">

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
        <div class="topbar-right">
            <a href="#" class="notif-btn">
                <i class="fas fa-bell"></i>
                <span class="notif-badge"><?= $totalBookingMenunggu ?? 0 ?></span>
            </a>
            <div class="admin-info">
                <img src="<?= BASE_URL ?>/public/assets/img/undraw_profile.svg"
                    class="admin-avatar" alt="Admin">
                <div>
                    <div class="admin-name"><?= $_SESSION['staff_name'] ?></div>
                    <div class="admin-role">Admin</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="page-content">
        <?= $content ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/public/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>/public/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<?= $scripts ?? '' ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
// Success & Error dari session
<?php if (isset($_SESSION['success'])): ?>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= $_SESSION['success'] ?>',
    confirmButtonColor: '#5B2D8E',
    timer: 2500,
    timerProgressBar: true,
    showConfirmButton: false
});
<?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '<?= $_SESSION['error'] ?>',
    confirmButtonColor: '#5B2D8E',
});
<?php unset($_SESSION['error']); ?>
<?php endif; ?>

// Konfirmasi Delete
function confirmDelete(url, nama = 'data ini') {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: nama + ' akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#5B2D8E',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
</body>
</html>