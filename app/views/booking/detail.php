<?php ob_start(); ?>

<div class="page-title">Detail Booking</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/booking">Booking</a></li>
        <li class="breadcrumb-item active">Detail Booking</li>
    </ol>
</nav>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $_SESSION['success'] ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-800 mb-0">
        Booking No. <?= str_pad($booking['id_booking'], 3, '0', STR_PAD_LEFT) ?>
    </h4>
    <form method="POST" action="<?= BASE_URL ?>/booking/detail/<?= $booking['id_booking'] ?>" class="d-flex align-items-center gap-2">
        <label class="mr-2 mb-0 small font-weight-600">Ubah Status</label>
        <select name="status_booking" class="form-control form-control-sm mr-2" style="width:160px; border-radius:8px">
            <option value="menunggu" <?= $booking['status_booking'] === 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
            <option value="dikonfirmasi" <?= $booking['status_booking'] === 'dikonfirmasi' ? 'selected' : '' ?>>Dikonfirmasi</option>
            <option value="disewa" <?= $booking['status_booking'] === 'disewa' ? 'selected' : '' ?>>On Progress</option>
            <option value="selesai" <?= $booking['status_booking'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
            <option value="dibatalkan" <?= $booking['status_booking'] === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
        </select>
        <button type="submit" class="btn btn-purple btn-sm">Simpan</button>
    </form>
</div>

<div class="row">
    <!-- Kiri: Info Customer -->
    <div class="col-md-6">
        <div class="table-card h-100">
            <h6 class="font-weight-700 mb-4" style="font-weight:700; font-size:1rem">Informasi Customer</h6>
            <table class="table table-borderless mb-0">
                <tr>
                    <td style="width:40%; color:#888; font-size:.88rem; padding:10px 0">Name</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= $booking['nama_cust'] ?></td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Whatsapp</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= $booking['no_tlp'] ?></td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Country of Origin</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= $booking['country_origin'] ?></td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Address</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= $booking['alamat'] ?></td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Pickup Method</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0">
                        <?= $booking['metode_pengambilan'] === 'ambil_sendiri' ? 'Pick up at the office' : 'Delivery to your location' ?>
                    </td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Payment Method</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= ucfirst($booking['metode_pembayaran']) ?></td>
                </tr>
                <?php if ($booking['titik_jemput']): ?>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Titik Jemput</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= $booking['titik_jemput'] ?></td>
                </tr>
                <?php endif; ?>
                <?php if ($booking['alamat_pengantaran']): ?>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Alamat Pengantaran</td>
                    <td style="font-weight:600; font-size:.92rem; padding:10px 0"><?= $booking['alamat_pengantaran'] ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <!-- Kanan: Konfirmasi Booking -->
    <div class="col-md-6">
        <div class="table-card h-100">
            <h6 class="font-weight-700 mb-4" style="font-weight:700; font-size:1rem">Konfirmasi Booking</h6>

            <!-- Armada -->
            <div class="d-flex align-items-center mb-4 p-3"
                style="background:#f8f9fc; border-radius:12px;">
                <?php if ($booking['gambar_armada']): ?>
                    <img src="<?= BASE_URL ?>/public/assets/img/armada/<?= $booking['gambar_armada'] ?>"
                        style="width:90px; height:70px; object-fit:cover; border-radius:8px; margin-right:16px">
                <?php else: ?>
                    <div style="width:90px; height:70px; background:#eee; border-radius:8px; margin-right:16px; display:flex; align-items:center; justify-content:center">
                        <i class="fas fa-car text-muted"></i>
                    </div>
                <?php endif; ?>
                <div>
                    <div style="font-size:.8rem; color:#999">No. Booking: <?= str_pad($booking['id_booking'], 3, '0', STR_PAD_LEFT) ?></div>
                    <div style="font-weight:700; font-size:1.05rem"><?= $booking['nama_armada'] ?></div>
                </div>
            </div>

            <!-- Detail -->
            <table class="table table-borderless mb-0">
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Type of Vehicle</td>
                    <td style="font-weight:700; font-size:.92rem; padding:10px 0; text-align:right"><?= $booking['nama_armada'] ?></td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Rent Start From</td>
                    <td style="font-weight:700; font-size:.92rem; padding:10px 0; text-align:right">
                        <?= date('d F Y', strtotime($booking['tgl_pinjam'])) ?>
                    </td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Rent Finish</td>
                    <td style="font-weight:700; font-size:.92rem; padding:10px 0; text-align:right">
                        <?= date('d F Y', strtotime($booking['tgl_kembali'])) ?>
                    </td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Long Lease</td>
                    <td style="font-weight:700; font-size:.92rem; padding:10px 0; text-align:right"><?= $booking['jumlah_hari'] ?> Hari</td>
                </tr>
                <tr style="border-top:1px solid #f5f5f5">
                    <td style="color:#888; font-size:.88rem; padding:10px 0">Pickup Method</td>
                    <td style="font-weight:700; font-size:.92rem; padding:10px 0; text-align:right">
                        <?= $booking['metode_pengambilan'] === 'ambil_sendiri' ? 'Pickup at the office' : 'Delivery' ?>
                    </td>
                </tr>
                <tr style="border-top:2px solid #f0f0f0">
                    <td style="font-weight:700; padding:12px 0">Total Payment</td>
                    <td style="font-weight:800; font-size:1rem; padding:12px 0; text-align:right; color:var(--primary)">
                        Rp <?= number_format($booking['total_bayar'], 0, ',', '.') ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Dokumen -->
<?php if ($booking['foto_sim'] || $booking['foto_ktp'] || $booking['foto_tiket'] || $booking['foto_hotel']): ?>
<div class="row mt-4">
    <?php
    $docs = [
        ['label' => 'Driving License', 'file' => $booking['foto_sim']],
        ['label' => 'Identity Card',   'file' => $booking['foto_ktp']],
        ['label' => 'Ticket Plane',    'file' => $booking['foto_tiket']],
        ['label' => 'Booking Hotel',   'file' => $booking['foto_hotel']],
    ];
    foreach ($docs as $doc):
        if (!$doc['file']) continue;
    ?>
    <div class="col-md-3 mb-4">
        <div class="table-card text-center">
            <h6 class="font-weight-700 mb-3" style="font-weight:700">Dokumen Customer</h6>
            <p class="text-muted small mb-2"><?= $doc['label'] ?></p>
            <img src="<?= BASE_URL ?>/public/assets/img/dokumen/<?= $doc['file'] ?>"
                style="width:100%; height:120px; object-fit:cover; border-radius:8px; margin-bottom:12px">
            <div class="small text-muted mb-3"><?= $doc['file'] ?></div>
            <a href="<?= BASE_URL ?>/public/assets/img/dokumen/<?= $doc['file'] ?>"
                target="_blank" class="btn btn-purple btn-sm w-100">
                <i class="fas fa-eye mr-1"></i> Lihat Dokumen
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Hapus -->
<div class="mt-2 mb-4">
    <a href="<?= BASE_URL ?>/booking" class="btn btn-outline-secondary btn-sm mr-2">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
   <a href="javascript:void(0)"
    class="btn btn-danger btn-sm"
    onclick="confirmDelete('<?= BASE_URL ?>/booking/delete/<?= $booking['id_booking'] ?>', 'Booking No. <?= str_pad($booking['id_booking'], 3, '0', STR_PAD_LEFT) ?>')">
    <i class="fas fa-trash mr-1"></i> Hapus Booking
</a>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/app/views/layouts/main.php';
?>