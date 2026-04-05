<?php ob_start(); ?>

<div class="page-title">Edit Customer</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/customer">Data Customer</a></li>
        <li class="breadcrumb-item active">Edit Customer</li>
    </ol>
</nav>

<div class="table-card" style="max-width:600px">
    <form method="POST" action="<?= BASE_URL ?>/customer/edit/<?= $customer['id_cust'] ?>">
        <div class="form-group">
            <label class="small font-weight-600">Nama Customer</label>
            <input type="text" name="nama_cust" class="form-control"
                value="<?= $customer['nama_cust'] ?>" required>
        </div>
        <div class="form-group">
            <label class="small font-weight-600">No. Whatsapp</label>
            <input type="text" name="no_tlp" class="form-control"
                value="<?= $customer['no_tlp'] ?>" required>
        </div>
        <div class="form-group">
            <label class="small font-weight-600">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"><?= $customer['alamat'] ?></textarea>
        </div>
        <div class="form-group">
            <label class="small font-weight-600">Country of Origin</label>
            <input type="text" name="country_origin" class="form-control"
                value="<?= $customer['country_origin'] ?>" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-purple mr-2">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
            <a href="<?= BASE_URL ?>/customer/detail/<?= $customer['id_cust'] ?>"
                class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/app/views/layouts/main.php';
?>