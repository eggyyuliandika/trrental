<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Vehicle - TR Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #5B2D8E;
            --primary-light: #7B4DB8;
            --primary-bg: #EAE4F3;
            --primary-soft: #f3eeff;
        }
        * { font-family: 'Segoe UI', sans-serif; }
        body { background: #f4f6fb; overflow-x: hidden; }

        /* Header */
        .booking-header {
            background: var(--primary);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 15px rgba(91,45,142,.3);
        }
        .header-inner {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            gap: 16px;
        }
        .btn-back {
            width: 36px; height: 36px;
            background: rgba(255,255,255,.2);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            text-decoration: none;
        }
        .btn-back:hover { background: rgba(255,255,255,.35); color: #fff; }
        .header-title {
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0;
        }

        /* Deco */
        .deco-top {
            position: fixed;
            top: -120px; right: -120px;
            width: 350px; height: 350px;
            background: var(--primary-bg);
            border-radius: 50%;
            z-index: 0;
            opacity: .5;
        }
        .deco-bottom {
            position: fixed;
            bottom: -100px; left: -100px;
            width: 280px; height: 280px;
            background: var(--primary-bg);
            border-radius: 50%;
            z-index: 0;
            opacity: .4;
        }

        /* Main Container */
        .booking-container {
            max-width: 1000px;
            margin: 30px auto 50px;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        /* Vehicle Card */
        .vehicle-sticky {
            position: sticky;
            top: 80px;
        }
        .vehicle-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(91,45,142,.12);
        }
        .vehicle-card-header {
            background: var(--primary);
            padding: 16px 20px;
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
            letter-spacing: .5px;
        }
        .vehicle-img-wrap {
            background: #f8f9fc;
            padding: 24px;
            text-align: center;
        }
        .vehicle-img-wrap img {
            max-height: 150px;
            object-fit: contain;
        }
        .vehicle-details {
            padding: 20px;
        }
        .vehicle-name {
            font-weight: 800;
            font-size: 1.1rem;
            color: #1a1a1a;
            margin-bottom: 4px;
        }
        .vehicle-sub {
            color: #999;
            font-size: .83rem;
            margin-bottom: 16px;
        }
        .vehicle-spec {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }
        .spec-badge {
            background: var(--primary-soft);
            color: var(--primary);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: .78rem;
            font-weight: 600;
        }
        .vehicle-price {
            background: var(--primary-soft);
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .price-label { color: #888; font-size: .82rem; }
        .price-value {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--primary);
        }

        /* Total Preview */
        .total-preview {
            background: var(--primary);
            color: #fff;
            border-radius: 12px;
            padding: 14px 16px;
            margin-top: 12px;
            display: none;
        }
        .total-preview .label { font-size: .82rem; opacity: .85; }
        .total-preview .amount { font-weight: 800; font-size: 1.2rem; margin-top: 4px; }

        /* Form Card */
        .form-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(91,45,142,.08);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .form-section-header {
            background: var(--primary-soft);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #ede6f9;
        }
        .form-section-header .icon {
            width: 32px; height: 32px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .85rem;
        }
        .form-section-header span {
            font-weight: 700;
            color: var(--primary);
            font-size: .92rem;
        }
        .form-section-body { padding: 24px; }

        /* Input Styles */
        .form-label {
            font-weight: 600;
            color: #444;
            font-size: .85rem;
            margin-bottom: 6px;
        }
        .form-label .req { color: #e74c3c; }
        .input-wrap {
            position: relative;
        }
        .input-wrap .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: .9rem;
            pointer-events: none;
        }
        .input-wrap input,
        .input-wrap textarea,
        .input-wrap select {
            padding-left: 38px;
        }
        .form-control {
            border: 1.5px solid #e8e0f5;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: .9rem;
            transition: all .2s;
            background: #fdfcff;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(91,45,142,.1);
            background: #fff;
        }
        textarea.form-control { border-radius: 12px; resize: none; }

        /* Radio Styled */
        .radio-group { display: flex; gap: 12px; flex-wrap: wrap; }
        .radio-card {
            flex: 1;
            min-width: 120px;
            border: 2px solid #e8e0f5;
            border-radius: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fdfcff;
        }
        .radio-card:hover { border-color: var(--primary); background: var(--primary-soft); }
        .radio-card input[type=radio] { accent-color: var(--primary); width: 16px; height: 16px; }
        .radio-card.selected { border-color: var(--primary); background: var(--primary-soft); }
        .radio-card .radio-label { font-weight: 600; font-size: .87rem; color: #444; }
        .radio-card .radio-sub { font-size: .75rem; color: #999; }

        /* Upload Area */
        .upload-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .upload-area {
            border: 2px dashed #d4c5f0;
            border-radius: 12px;
            padding: 20px 12px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: #fdfcff;
            position: relative;
            overflow: hidden;
        }
        .upload-area:hover { border-color: var(--primary); background: var(--primary-soft); }
        .upload-area input[type=file] {
            position: absolute; inset: 0;
            opacity: 0; cursor: pointer;
            width: 100%; height: 100%;
        }
        .upload-icon {
            width: 44px; height: 44px;
            background: var(--primary-soft);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px;
            color: var(--primary);
            font-size: 1.1rem;
        }
        .upload-label { font-weight: 700; font-size: .82rem; color: #444; margin-bottom: 4px; }
        .upload-hint { font-size: .75rem; color: #aaa; }
        .upload-hint span { color: var(--primary); font-weight: 600; }
        .preview-img {
            width: 100%; height: 80px;
            object-fit: cover;
            border-radius: 8px;
            display: none;
            margin-bottom: 8px;
        }

        /* Notes Box */
        .notes-box {
            background: linear-gradient(135deg, #f9f5ff, #f0eaff);
            border: 1.5px solid #ddd0f5;
            border-radius: 14px;
            padding: 20px 24px;
        }
        .notes-box h6 {
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .notes-box ul { margin: 0; padding-left: 20px; }
        .notes-box li { font-size: .87rem; color: #555; margin-bottom: 6px; line-height: 1.5; }

        /* Submit Button */
        .btn-submit {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all .3s;
            letter-spacing: .3px;
        }
        .btn-submit:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91,45,142,.3);
        }
        .btn-submit i { margin-right: 8px; }
    </style>
</head>
<body>

<div class="deco-top"></div>
<div class="deco-bottom"></div>

<!-- Header -->
<div class="booking-header">
    <div class="header-inner">
        <a href="javascript:history.back()" class="btn-back">
            <i class="fas fa-chevron-left"></i>
        </a>
        <p class="header-title">Book Your Vehicle</p>
    </div>
</div>

<div class="booking-container">
    <div class="row">

        <!-- Form Kiri -->
        <div class="col-lg-7 mb-4">
            <form method="POST" action="<?= BASE_URL ?>/home/booking/<?= $armada['id_armada'] ?>"
                enctype="multipart/form-data" id="bookingForm">

                <!-- Data Diri -->
                <div class="form-card mb-4">
                    <div class="form-section-header">
                        <div class="icon"><i class="fas fa-user"></i></div>
                        <span>Personal Information</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" name="nama_cust" class="form-control"
                                            placeholder="Your full name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Whatsapp <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fab fa-whatsapp input-icon"></i>
                                        <input type="text" name="no_tlp" class="form-control"
                                            placeholder="+62..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Country of Origin <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-globe input-icon"></i>
                                        <input type="text" name="country_origin" class="form-control"
                                            placeholder="e.g. Indonesia" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Address <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-map-marker-alt input-icon"></i>
                                        <input type="text" name="alamat" class="form-control"
                                            placeholder="Your address" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rental Schedule -->
                <div class="form-card mb-4">
                    <div class="form-section-header">
                        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                        <span>Rental Schedule</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Rent Start From <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-calendar input-icon"></i>
                                        <input type="date" name="tgl_pinjam" id="tgl_pinjam"
                                            class="form-control" min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Rent Finish <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-calendar-check input-icon"></i>
                                        <input type="date" name="tgl_kembali" id="tgl_kembali"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pickup & Delivery -->
                <div class="form-card mb-4">
                    <div class="form-section-header">
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <span>Pickup & Delivery</span>
                    </div>
                    <div class="form-section-body">
                        <div class="form-group">
                            <label class="form-label">Pickup Method <span class="req">*</span></label>
                            <div class="radio-group">
                                <label class="radio-card selected" id="card_ambil">
                                    <input type="radio" name="metode_pengambilan"
                                        value="ambil_sendiri" checked
                                        onchange="togglePickup(this)">
                                    <div>
                                        <div class="radio-label"><i class="fas fa-store mr-1"></i> Pick Up</div>
                                        <div class="radio-sub">At the office</div>
                                    </div>
                                </label>
                                <label class="radio-card" id="card_antar">
                                    <input type="radio" name="metode_pengambilan"
                                        value="antar_jemput"
                                        onchange="togglePickup(this)">
                                    <div>
                                        <div class="radio-label"><i class="fas fa-motorcycle mr-1"></i> Delivery</div>
                                        <div class="radio-sub">To your location</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="delivery_fields" style="display:none">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Pickup Address</label>
                                        <div class="input-wrap">
                                            <i class="fas fa-map-pin input-icon"></i>
                                            <input type="text" name="titik_jemput" class="form-control"
                                                placeholder="Where to pick you up">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Drop Address</label>
                                        <div class="input-wrap">
                                            <i class="fas fa-flag input-icon"></i>
                                            <input type="text" name="alamat_pengantaran" class="form-control"
                                                placeholder="Where to drop off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jika ambil sendiri, tetap kirim field kosong -->
                        <div id="hidden_fields">
                            <input type="hidden" name="titik_jemput" value="">
                            <input type="hidden" name="alamat_pengantaran" value="">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="form-card mb-4">
                    <div class="form-section-header">
                        <div class="icon"><i class="fas fa-credit-card"></i></div>
                        <span>Payment Method</span>
                    </div>
                    <div class="form-section-body">
                        <div class="radio-group">
                            <label class="radio-card selected" id="card_transfer">
                                <input type="radio" name="metode_pembayaran"
                                    value="transfer" checked onchange="selectPayment('card_transfer')">
                                <div>
                                    <div class="radio-label"><i class="fas fa-university mr-1"></i> Transfer</div>
                                    <div class="radio-sub">Bank transfer</div>
                                </div>
                            </label>
                            <label class="radio-card" id="card_tunai">
                                <input type="radio" name="metode_pembayaran"
                                    value="tunai" onchange="selectPayment('card_tunai')">
                                <div>
                                    <div class="radio-label"><i class="fas fa-money-bill mr-1"></i> Cash</div>
                                    <div class="radio-sub">Pay in person</div>
                                </div>
                            </label>
                            <label class="radio-card" id="card_qris">
                                <input type="radio" name="metode_pembayaran"
                                    value="qris" onchange="selectPayment('card_qris')">
                                <div>
                                    <div class="radio-label"><i class="fas fa-qrcode mr-1"></i> QRIS</div>
                                    <div class="radio-sub">Scan to pay</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Upload Documents -->
                <div class="form-card mb-4">
                    <div class="form-section-header">
                        <div class="icon"><i class="fas fa-file-upload"></i></div>
                        <span>Upload Documents</span>
                    </div>
                    <div class="form-section-body">
                        <div class="upload-grid">
                            <!-- SIM -->
                            <div>
                                <label class="form-label">Driver License <span class="req">*</span></label>
                                <div class="upload-area" id="area_sim">
                                    <input type="file" name="foto_sim" accept="image/*"
                                        onchange="previewUpload(this, 'area_sim', 'prev_sim')" required>
                                    <img class="preview-img" id="prev_sim">
                                    <div id="placeholder_sim">
                                        <div class="upload-icon"><i class="fas fa-id-card"></i></div>
                                        <div class="upload-label">Driver License</div>
                                        <div class="upload-hint"><span>Click to upload</span> or drag & drop</div>
                                        <div class="upload-hint">JPG, PNG max 10MB</div>
                                    </div>
                                </div>
                            </div>
                            <!-- KTP -->
                            <div>
                                <label class="form-label">Identity Card <span class="req">*</span></label>
                                <div class="upload-area" id="area_ktp">
                                    <input type="file" name="foto_ktp" accept="image/*"
                                        onchange="previewUpload(this, 'area_ktp', 'prev_ktp')" required>
                                    <img class="preview-img" id="prev_ktp">
                                    <div id="placeholder_ktp">
                                        <div class="upload-icon"><i class="fas fa-address-card"></i></div>
                                        <div class="upload-label">Identity Card</div>
                                        <div class="upload-hint"><span>Click to upload</span> or drag & drop</div>
                                        <div class="upload-hint">JPG, PNG max 10MB</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tiket -->
                            <div>
                                <label class="form-label">Ticket Plane <small class="text-muted">(optional)</small></label>
                                <div class="upload-area" id="area_tiket">
                                    <input type="file" name="foto_tiket" accept="image/*"
                                        onchange="previewUpload(this, 'area_tiket', 'prev_tiket')">
                                    <img class="preview-img" id="prev_tiket">
                                    <div id="placeholder_tiket">
                                        <div class="upload-icon"><i class="fas fa-plane"></i></div>
                                        <div class="upload-label">Ticket Plane</div>
                                        <div class="upload-hint"><span>Click to upload</span> or drag & drop</div>
                                        <div class="upload-hint">JPG, PNG max 10MB</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hotel -->
                            <div>
                                <label class="form-label">Booking Hotel <small class="text-muted">(optional)</small></label>
                                <div class="upload-area" id="area_hotel">
                                    <input type="file" name="foto_hotel" accept="image/*"
                                        onchange="previewUpload(this, 'area_hotel', 'prev_hotel')">
                                    <img class="preview-img" id="prev_hotel">
                                    <div id="placeholder_hotel">
                                        <div class="upload-icon"><i class="fas fa-hotel"></i></div>
                                        <div class="upload-label">Booking Hotel</div>
                                        <div class="upload-hint"><span>Click to upload</span> or drag & drop</div>
                                        <div class="upload-hint">JPG, PNG max 10MB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="notes-box mb-4">
                    <h6><i class="fas fa-info-circle"></i> Important Notes</h6>
                    <ul>
                        <li>All customers are required to make a deposit as a guarantee.</li>
                        <li>For cars, the deposit is <strong>$130 (2 million IDR)</strong>. It will be refunded once the car is returned.</li>
                        <li>For motorcycles, the deposit is <strong>$32 (500 thousand IDR)</strong>. It will be refunded once the motorcycle is returned.</li>
                    </ul>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Booking
                </button>

            </form>
        </div>

        <!-- Kanan: Vehicle Summary -->
        <div class="col-lg-5 mb-4">
            <div class="vehicle-sticky">
                <div class="vehicle-card">
                    <div class="vehicle-card-header">
                        <i class="fas fa-car mr-2"></i> Vehicle Summary
                    </div>
                    <div class="vehicle-img-wrap">
                        <?php if ($armada['gambar_armada']): ?>
                            <img src="<?= BASE_URL ?>/public/assets/img/armada/<?= $armada['gambar_armada'] ?>"
                                class="img-fluid" alt="<?= $armada['nama_armada'] ?>">
                        <?php else: ?>
                            <i class="fas fa-car fa-5x" style="color:#ddd"></i>
                        <?php endif; ?>
                    </div>
                    <div class="vehicle-details">
                        <div class="vehicle-name"><?= $armada['nama_armada'] ?></div>
                        <div class="vehicle-sub"><?= $armada['merk_armada'] ?> · <?= $armada['tipe_armada'] ?></div>
                        <div class="vehicle-spec">
                            <span class="spec-badge"><i class="fas fa-cog mr-1"></i><?= $armada['transmisi'] ?></span>
                            <span class="spec-badge"><i class="fas fa-calendar mr-1"></i><?= $armada['tahun_armada'] ?></span>
                            <span class="spec-badge"><i class="fas fa-id-card mr-1"></i><?= $armada['plat_armada'] ?></span>
                        </div>
                        <div class="vehicle-price">
                            <div class="price-label">Price per day</div>
                            <div class="price-value">Rp <?= number_format($armada['harga_sewa_perhari'], 0, ',', '.') ?></div>
                        </div>

                        <!-- Total Preview -->
                        <div class="total-preview" id="totalPreview">
                            <div class="label">Estimated Total</div>
                            <div class="amount" id="totalAmount">-</div>
                            <div style="font-size:.78rem; opacity:.8; margin-top:4px" id="totalDetail"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const hargaPerHari = <?= $armada['harga_sewa_perhari'] ?>;

// Hitung Total
function hitungTotal() {
    const p = new Date($('#tgl_pinjam').val());
    const k = new Date($('#tgl_kembali').val());
    if ($('#tgl_pinjam').val() && $('#tgl_kembali').val() && k > p) {
        const hari  = Math.round((k - p) / 86400000);
        const total = hari * hargaPerHari;
        $('#totalAmount').text('Rp ' + total.toLocaleString('id-ID'));
        $('#totalDetail').text(hari + ' day(s) × Rp ' + hargaPerHari.toLocaleString('id-ID'));
        $('#totalPreview').fadeIn();
    } else {
        $('#totalPreview').fadeOut();
    }
}

$('#tgl_pinjam').on('change', function() {
    $('#tgl_kembali').attr('min', $(this).val());
    hitungTotal();
});
$('#tgl_kembali').on('change', hitungTotal);

// Toggle Pickup
function togglePickup(el) {
    if (el.value === 'antar_jemput') {
        $('#delivery_fields').slideDown();
        $('#hidden_fields').hide();
        $('#card_ambil').removeClass('selected');
        $('#card_antar').addClass('selected');
    } else {
        $('#delivery_fields').slideUp();
        $('#hidden_fields').show();
        $('#card_antar').removeClass('selected');
        $('#card_ambil').addClass('selected');
    }
}

// Select Payment
function selectPayment(cardId) {
    $('.radio-card').removeClass('selected');
    $('#' + cardId).addClass('selected');
}

// Preview Upload
function previewUpload(input, areaId, prevId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById(prevId);
            img.src = e.target.result;
            img.style.display = 'block';
            const placeholderId = 'placeholder_' + areaId.replace('area_', '');
            document.getElementById(placeholderId).style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}
</script>
</body>
</html>