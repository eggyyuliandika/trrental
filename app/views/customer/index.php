<?php ob_start(); ?>

<div class="page-title">Data Customer</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $_SESSION['success'] ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="table-card">
    <!-- Search -->
    <div class="mb-4" style="position:relative; max-width:400px;">
        <i class="fas fa-search" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#aaa"></i>
        <input type="text" id="searchCustomer" class="form-control"
            placeholder="Cari customer..."
            style="padding-left:40px; border-radius:25px; border:1.5px solid #eee; background:#f8f9fc;">
    </div>

    <div class="table-responsive">
        <table class="table" id="customerTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Whatsapp</th>
                    <th>Country of Origin</th>
                    <th>Address</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $i => $c): ?>
                <tr>
                    <td><?= str_pad($c['id_cust'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td><?= $c['nama_cust'] ?></td>
                    <td><?= $c['no_tlp'] ?></td>
                    <td><?= $c['country_origin'] ?></td>
                    <td><?= $c['alamat'] ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/customer/detail/<?= $c['id_cust'] ?>"
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
$content = ob_get_clean();
$scripts = '
<script>
$(document).ready(function(){
    var table = $("#customerTable").DataTable({order:[]});
    $("#searchCustomer").on("keyup", function(){
        table.search(this.value).draw();
    });
});
</script>';
require_once BASE_PATH . '/app/views/layouts/main.php';
?>