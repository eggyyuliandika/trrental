<?php
class HomeController extends Controller {
    private $armadaModel;

    public function __construct() {
        $this->armadaModel = $this->model('ArmadaModel');
    }

    public function index() {
        $data = [
            'title'  => 'TR Rental - Sewa Kendaraan',
            'armada' => $this->armadaModel->getArmadaTersedia(),
        ];
        $this->view('home/index', $data);
    }

    public function products() {
        $data = [
            'title'  => 'Products - TR Rental',
            'armada' => $this->armadaModel->getArmadaTersedia(),
        ];
        $this->view('home/products', $data);
    }

    public function booking($id_armada = null) {
        if (!$id_armada) $this->redirect('');

        $armada = $this->armadaModel->getById($id_armada);
        if (!$armada || $armada['status_armada'] !== 'tersedia') {
            $this->redirect('home/products');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = getDB();

            // Simpan customer
            $nama    = trim($_POST['nama_cust']);
            $no_tlp  = trim($_POST['no_tlp']);
            $alamat  = trim($_POST['alamat']);
            $country = trim($_POST['country_origin']);

            $stmt = $db->prepare("INSERT INTO cust (nama_cust, no_tlp, alamat, country_origin) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $nama, $no_tlp, $alamat, $country);
            $stmt->execute();
            $id_cust = $db->insert_id;

            // Upload dokumen
            $uploadDir = BASE_PATH . '/public/assets/img/dokumen/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $foto_sim   = $this->uploadDokumen('foto_sim', $uploadDir);
            $foto_ktp   = $this->uploadDokumen('foto_ktp', $uploadDir);
            $foto_tiket = $this->uploadDokumen('foto_tiket', $uploadDir);
            $foto_hotel = $this->uploadDokumen('foto_hotel', $uploadDir);

            // Hitung total bayar
            $tgl_pinjam  = $_POST['tgl_pinjam'];
            $tgl_kembali = $_POST['tgl_kembali'];
            $jumlah_hari = (int)((strtotime($tgl_kembali) - strtotime($tgl_pinjam)) / 86400);
            $total_bayar = $jumlah_hari * $armada['harga_sewa_perhari'];

            // Simpan booking
            $metode_pengambilan = $_POST['metode_pengambilan'];
            $titik_jemput       = $_POST['titik_jemput'] ?? '';
            $alamat_pengantaran = $_POST['alamat_pengantaran'] ?? '';
            $metode_pembayaran  = $_POST['metode_pembayaran'];

            $stmt2 = $db->prepare("INSERT INTO booking 
                (id_cust, id_armada, tgl_pinjam, tgl_kembali, jumlah_hari,
                 metode_pengambilan, titik_jemput, alamat_pengantaran,
                 metode_pembayaran, status_booking, total_bayar,
                 foto_sim, foto_ktp, foto_tiket, foto_hotel, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'menunggu', ?, ?, ?, ?, ?, NOW())");

            $stmt2->bind_param(
    'iississsidssss',
    $id_cust, $id_armada, $tgl_pinjam, $tgl_kembali, $jumlah_hari,
    $metode_pengambilan, $titik_jemput, $alamat_pengantaran,
    $metode_pembayaran, $total_bayar,
    $foto_sim, $foto_ktp, $foto_tiket, $foto_hotel
);
            $stmt2->execute();

            // Update status armada jadi disewa
            $db->query("UPDATE armada SET status_armada = 'disewa' WHERE id_armada = $id_armada");

            $this->redirect('home/sukses');
        } else {
            $data = [
                'title'  => 'Book Your Vehicle - TR Rental',
                'armada' => $armada,
            ];
            $this->view('home/booking', $data);
        }
    }

    public function sukses() {
        $this->view('home/sukses', ['title' => 'Booking Berhasil']);
    }

    private function uploadDokumen($field, $uploadDir) {
        if (empty($_FILES[$field]['name'])) return null;
        $ext      = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $allowed  = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array(strtolower($ext), $allowed)) return null;
        $fileName = uniqid($field . '_') . '.' . $ext;
        move_uploaded_file($_FILES[$field]['tmp_name'], $uploadDir . $fileName);
        return $fileName;
    }
}