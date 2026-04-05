<?php ob_start(); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Armada</h1>
    <a href="<?= BASE_URL ?>/armada" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/armada/create" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Armada</label>
                        <input type="text" name="nama_armada" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Merk</label>
                        <input type="text" name="merk_armada" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <input type="text" name="tipe_armada" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Plat Nomor</label>
                        <input type="text" name="plat_armada" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="tahun_armada" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Transmisi</label>
                        <select name="transmisi" class="form-control">
                            <option value="Manual">Manual</option>
                            <option value="Matic">Matic</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa/Hari (Rp)</label>
                        <input type="number" name="harga_sewa_perhari" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status_armada" class="form-control">
                            <option value="tersedia">Tersedia</option>
                            <option value="disewa">Disewa</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto Armada</label>
                        <input type="file" name="gambar_armada" class="form-control-file" accept="image/*">
                        <small class="text-muted">Format: jpg, jpeg, png, webp</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/app/views/layouts/main.php';
?>