<?php ob_start(); ?>

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