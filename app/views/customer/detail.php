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
        <a href="javascript:void(0)"
    class="btn btn-danger btn-sm"
    onclick="confirmDelete('<?= BASE_URL ?>/customer/delete/<?= $customer['id_cust'] ?>', '<?= $customer['nama_cust'] ?>')">
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
?><?php ob_start(); ?>

<div class="page-title">Laporan</div>
<div class="page-subtitle">Melihat performa bisnis penyewaan kendaraan.</div>

<!-- Filter -->
<div class="table-card mb-4">
    <h6 class="font-weight-700 mb-3" style="font-weight:700">Filter Laporan</h6>
    <form method="GET" action="<?= BASE_URL ?>/laporan">
        <div class="row align-items-end">
            <div class="col-md-2">
                <label class="small font-weight-600">Tanggal Awal</label>
                <input type="date" name="tgl_awal" class="form-control form-control-sm"
                    value="<?= $filter['tgl_awal'] ?>">
            </div>
            <div class="col-md-2">
                <label class="small font-weight-600">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" class="form-control form-control-sm"
                    value="<?= $filter['tgl_akhir'] ?>">
            </div>
            <div class="col-md-2">
                <label class="small font-weight-600">Tahun Grafik</label>
                <input type="number" name="tahun" class="form-control form-control-sm"
                    value="<?= $tahun ?>" min="2020" max="2030">
            </div>
            <div class="col-md-4">
                <label class="small font-weight-600 d-block">Kegiatan</label>
                <div class="btn-group" role="group">
                    <?php foreach (['semua' => 'Semua', 'penyewaan' => 'Penyewaan', 'pendapatan' => 'Pendapatan'] as $val => $label): ?>
                    <button type="submit" name="kegiatan" value="<?= $val ?>"
                        class="btn btn-sm <?= $filter['kegiatan'] === $val ? 'btn-purple' : 'btn-outline-secondary' ?>">
                        <?= $label ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-purple btn-sm mr-2">
                    <i class="fas fa-filter"></i> Terapkan
                </button>
                <a href="<?= BASE_URL ?>/laporan" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </div>
    </form>
</div>

<!-- Total Pendapatan -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: var(--primary); color:#fff">
            <div style="font-size:.85rem; opacity:.85">Total Pendapatan (Filter)</div>
            <div style="font-size:1.6rem; font-weight:800; margin-top:8px">
                Rp <?= number_format($totalPendapatan, 0, ',', '.') ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div style="font-size:.85rem; color:#999">Total Transaksi</div>
            <div style="font-size:1.6rem; font-weight:800; margin-top:8px; color:#333">
                <?= count($bookings) ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div style="font-size:.85rem; color:#999">Rata-rata per Transaksi</div>
            <div style="font-size:1.6rem; font-weight:800; margin-top:8px; color:#333">
                Rp <?= count($bookings) > 0 ? number_format($totalPendapatan / count($bookings), 0, ',', '.') : 0 ?>
            </div>
        </div>
    </div>
</div>

<!-- Grafik & Tersering -->
<div class="row mb-4">
    <!-- Grafik Pendapatan -->
    <div class="col-md-7">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="font-weight-700 mb-0" style="font-weight:700">Grafik Pendapatan <?= $tahun ?></h6>
            </div>
            <canvas id="chartPendapatan" height="120"></canvas>
        </div>
    </div>

    <!-- Armada Tersering -->
    <div class="col-md-5">
        <div class="table-card">
            <h6 class="font-weight-700 mb-4" style="font-weight:700">Kendaraan Paling Sering Disewa</h6>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kendaraan</th>
                        <th>Total Disewa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($armadaTersering as $i => $a): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $a['nama_armada'] ?></td>
                        <td><?= $a['total_disewa'] ?>x</td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($armadaTersering)): ?>
                    <tr><td colspan="3" class="text-center text-muted">Belum ada data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tabel Booking -->
<div class="table-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="font-weight-700 mb-0" style="font-weight:700">Data Booking Terbaru</h6>
        <div>
            <a href="<?= BASE_URL ?>/laporan/exportPdf?<?= http_build_query(array_merge($filter, ['tahun' => $tahun])) ?>"
                class="btn btn-sm btn-danger mr-2">
                <i class="fas fa-file-pdf mr-1"></i> Export PDF
            </a>
            <a href="<?= BASE_URL ?>/laporan/exportExcel?<?= http_build_query(array_merge($filter, ['tahun' => $tahun])) ?>"
                class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-1"></i> Export Excel
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="laporanTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Armada</th>
                    <th>Tgl Pinjam</th>
                    <th></th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= str_pad($b['id_booking'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td><?= $b['nama_cust'] ?></td>
                    <td><?= $b['nama_armada'] ?></td>
                    <td><?= date('d F Y', strtotime($b['tgl_pinjam'])) ?></td>
                    <td><i class="fas fa-arrow-right text-muted"></i></td>
                    <td><?= date('d F Y', strtotime($b['tgl_kembali'])) ?></td>
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
                        $badgeLabel = match($b['status_booking']) {
                            'menunggu'     => 'Menunggu',
                            'dikonfirmasi' => 'Dikonfirmasi',
                            'disewa'       => 'On Progress',
                            'selesai'      => 'Done',
                            'dibatalkan'   => 'Dibatalkan',
                            default        => '-'
                        };
                        ?>
                        <span class="status-badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
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

<?php
$pendapatanJson = json_encode(array_values($pendapatanBulanan));
$content = ob_get_clean();
$scripts = <<<SCRIPT
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function(){
    $("#laporanTable").DataTable({order:[]});

    const ctx = document.getElementById('chartPendapatan').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: $pendapatanJson,
                borderColor: '#5B2D8E',
                backgroundColor: 'rgba(91,45,142,.1)',
                borderWidth: 2.5,
                pointBackgroundColor: '#5B2D8E',
                pointRadius: 4,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: val => 'Rp ' + (val/1000) + 'k'
                    },
                    grid: { color: '#f0f0f0' }
                },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
SCRIPT;
require_once BASE_PATH . '/app/views/layouts/main.php';
?>