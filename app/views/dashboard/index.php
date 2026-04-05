<?php
ob_start();
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Stats Cards -->
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Armada</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalArmada ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp <?= number_format($totalPendapatan, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Booking</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBooking ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Customer</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalCustomer ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Booking Terbaru -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking Terbaru</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Armada</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookingTerbaru as $i => $b): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $b['nama_cust'] ?></td>
                        <td><?= $b['nama_armada'] ?></td>
                        <td><?= $b['tgl_pinjam'] ?></td>
                        <td><?= $b['tgl_kembali'] ?></td>
                        <td>Rp <?= number_format($b['total_bayar'], 0, ',', '.') ?></td>
                        <td>
                            <?php
                            $badge = match($b['status_booking']) {
                                'menunggu'  => 'warning',
                                'dikonfirmasi' => 'info',
                                'disewa'    => 'primary',
                                'selesai'   => 'success',
                                'dibatalkan'=> 'danger',
                                default     => 'secondary'
                            };
                            ?>
                            <span class="badge badge-<?= $badge ?>">
                                <?= ucfirst($b['status_booking']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$scripts = '<script>$(document).ready(function(){$("#dataTable").DataTable();});</script>';
require_once BASE_PATH . '/app/views/layouts/main.php';
?>