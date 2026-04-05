<?php
ob_start();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Armada</h1>
    <a href="<?= BASE_URL ?>/armada/create" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Armada
    </a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama Armada</th>
                        <th>Merk / Tipe</th>
                        <th>Plat</th>
                        <th>Tahun</th>
                        <th>Transmisi</th>
                        <th>Harga/Hari</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($armada as $i => $a): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td class="text-center">
                            <?php if ($a['gambar_armada']): ?>
                                <img src="<?= BASE_URL ?>/public/assets/img/armada/<?= $a['gambar_armada'] ?>"
                                    width="60" height="45" style="object-fit:cover; border-radius:4px;">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $a['nama_armada'] ?></td>
                        <td><?= $a['merk_armada'] ?> / <?= $a['tipe_armada'] ?></td>
                        <td><?= $a['plat_armada'] ?></td>
                        <td><?= $a['tahun_armada'] ?></td>
                        <td><?= $a['transmisi'] ?></td>
                        <td>Rp <?= number_format($a['harga_sewa_perhari'], 0, ',', '.') ?></td>
                        <td>
                            <?php $badge = $a['status_armada'] === 'tersedia' ? 'success' : 'danger'; ?>
                            <span class="badge badge-<?= $badge ?>"><?= ucfirst($a['status_armada']) ?></span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/armada/edit/<?= $a['id_armada'] ?>"
                                class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                           <a href="javascript:void(0)"
    class="btn btn-danger btn-sm"
    onclick="confirmDelete('<?= BASE_URL ?>/armada/delete/<?= $a['id_armada'] ?>', '<?= $a['nama_armada'] ?>')">
    <i class="fas fa-trash"></i>
</a>
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