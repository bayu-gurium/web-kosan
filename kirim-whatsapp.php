<!-- <?php
require_once 'vendor/autoload.php'; // Pastikan path autoload Composer benar
include 'config-secret.php';

use Twilio\Rest\Client;
use Twilio\Rest\Content\V1\TwilioCallToAction;

// Ganti dengan SID dan Token yang Anda dapatkan dari Twilio
$sid =  '';
$token = '';
// $twilioSid = getenv('TWILIO_SID');
// $authToken = getenv('TWILIO_AUTH_TOKEN');


$client = new Client($sid, $token);

// Data dari form
$nama_penghuni = $_POST['nama_penghuni'];
$jumlah_tagihan = $_POST['jumlah_tagihan'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];
$no_penghuni = $_POST['no_penghuni']; // Nomor WhatsApp tujuan, pastikan format internasional

// Buat pesan
$pesan = "Halo $nama_penghuni,\n\n"
    . "Kami dari Admin Kosan Batak ingin mengingatkan Anda mengenai tagihan kos Anda yang sebesar Rp. "
    . number_format($jumlah_tagihan) . ".\n\n"
    . "Tagihan ini memiliki tanggal jatuh tempo pada $tanggal_pembayaran. Mohon pastikan untuk melakukan pembayaran sebelum tanggal tersebut untuk menghindari denda atau gangguan pada layanan.\n\n"
    . "Terima kasih atas perhatian dan kerjasamanya.\n\n"
    . "Salam hangat,\n"
    . "Admin Kosan Batak";

try {
    // Kirim pesan melalui WhatsApp
    $message = $client->messages->create(
        "whatsapp:$no_penghuni", // Nomor WhatsApp tujuan dalam format internasional
        [
            'from' => 'whatsapp:+14155238886', // Nomor WhatsApp Twilio 
            'body' => $pesan
        ]
    );
    // Redirect ke halaman penghuni.php dengan pesan sukses
    echo "<script>
        alert('Pesan berhasil dikirimkan ke $nama_penghuni');
        window.location.href = 'penghuni.php';
    </script>";
} catch (Exception $e) {
    // Tampilkan pesan error dan tetap di halaman saat ini
    echo "<script>
        alert('Gagal mengirim pesan: " . addslashes($e->getMessage()) . "');
        window.location.href = 'penghuni.php';
    </script>";
} -->
