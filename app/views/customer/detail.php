<?php ob_start(); ?>

<div class="page-title">Detail Data Customer</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/customer">Data Customer</a></li>
        <li class="breadcrumb-item active">Detail Data Customer</li>
    </ol>
</nav>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $_SESSION['success'] ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Action Buttons -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?= BASE_URL ?>/customer" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Data Customer
    </a>
    <div>
        <a href="<?= BASE_URL ?>/customer/edit/<?= $customer['id_cust'] ?>"
            class="btn btn-purple btn-sm mr-2">
            <i class="fas fa-edit mr-1"></i> Ubah Data
        </a>
        <a href="<?= BASE_URL ?>/customer/delete/<?= $customer['id_cust'] ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin hapus customer ini?')">
            <i class="fas fa-trash mr-1"></i> Hapus
        </a>
    </div>
</div>

<!-- Header Customer -->
<div class="table-card mb-4 d-flex justify-content-between align-items-center"
    style="background: #f0eaf8;">
    <h5 class="mb-0 font-weight-800"><?= $customer['nama_cust'] ?></h5>
    <span class="text-muted small">ID Customer : <?= str_pad($customer['id_cust'], 3, '0', STR_PAD_LEFT) ?></span>
</div>

<div class="row">
    <!-- Info Customer -->
    <div class="col-md-4 mb-4">
        <div class="table-card h-100">
            <h6 class="font-weight-700 mb-4 text-center" style="font-weight:700">Informasi Customer</h6>
            <table class="table table-borderless mb-0">
                <tr>
                    <td colspan="2" style="border-bottom:1px solid #f5f5f5; padding:10px 0">
                        <div style="color:#888; font-size:.82rem">Name</div>
                        <div style="font-weight:600"><?= $customer['nama_cust'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom:1px solid #f5f5f5; padding:10px 0">
                        <div style="color:#888; font-size:.82rem">Whatsapp</div>
                        <div style="font-weight:600"><?= $customer['no_tlp'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom:1px solid #f5f5f5; padding:10px 0">
                        <div style="color:#888; font-size:.82rem">Country of Origin</div>
                        <div style="font-weight:600"><?= $customer['country_origin'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:10px 0">
                        <div style="color:#888; font-size:.82rem">Address</div>
                        <div style="font-weight:600"><?= $customer['alamat'] ?></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Dokumen dari Booking Terakhir -->
    <?php
    $lastBooking = !empty($bookings) ? $bookings[0] : null;
    $docs = [
        ['label' => 'Driving License', 'file' => $lastBooking['foto_sim'] ?? null],
        ['label' => 'Identity Card',   'file' => $lastBooking['foto_ktp'] ?? null],
        ['label' => 'Ticket Plane',    'file' => $lastBooking['foto_tiket'] ?? null],
        ['label' => 'Booking Hotel',   'file' => $lastBooking['foto_hotel'] ?? null],
    ];
    foreach ($docs as $doc):
        if (!$doc['file']) continue;
    ?>
    <div class="col-md-4 mb-4">
        <div class="table-card text-center h-100">
            <h6 class="font-weight-700 mb-2 text-center" style="font-weight:700">Dokumen Customer</h6>
            <p class="text-muted small mb-3"><?= $doc['label'] ?></p>
            <img src="<?= BASE_URL ?>/public/assets/img/dokumen/<?= $doc['file'] ?>"
                style="width:100%; height:130px; object-fit:cover; border-radius:10px; margin-bottom:10px">
            <div class="small text-muted mb-3"><?= $doc['file'] ?></div>
            <a href="<?= BASE_URL ?>/public/assets/img/dokumen/<?= $doc['file'] ?>"
                target="_blank" class="btn btn-purple btn-sm w-100">
                <i class="fas fa-eye mr-1"></i> Lihat Dokumen
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Riwayat Booking -->
<?php if (!empty($bookings)): ?>
<div class="table-card mt-2">
    <h6 class="font-weight-700 mb-4" style="font-weight:700">Riwayat Booking</h6>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No. Booking</th>
                    <th>Armada</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= str_pad($b['id_booking'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td><?= $b['nama_armada'] ?></td>
                    <td><?= date('d F Y', strtotime($b['tgl_pinjam'])) ?></td>
                    <td><?= date('d F Y', strtotime($b['tgl_kembali'])) ?></td>
                    <td>Rp <?= number_format($b['total_bayar'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $badgeClass = match($b['status_booking']) {
                            'menunggu'     => 'badge-menunggu',
                            'dikonfirmasi' => 'badge-dikonfirmasi',
                            'disewa'       => 'badge-disewa',
                            'selesai'      => 'badge-selesai',
                            'dibatalkan'   => 'badge-dibatalkan',
                            default        => 'badge-menunggu'
                        };
                        ?>
                        <span class="status-badge <?= $badgeClass ?>">
                            <?= ucfirst($b['status_booking']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>/booking/detail/<?= $b['id_booking'] ?>"
                            class="btn-detail">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/app/views/layouts/main.php';
?>