<?php

// header('Content-Type: application/json');

// Fungsi untuk melakukan request ke API dan mendapatkan data JSON
function getData($url) {
    $ch = curl_init($url); // Inisialisasi curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set opsi curl
    $response = json_decode(curl_exec($ch)); // Eksekusi curl dan parsing respons JSON
    curl_close($ch); // Tutup curl
    return $response;
}
// Memeriksa  parameter 'urlProfilkes' ada dalam permintaan GET
if (isset($_GET['urlProfilkes'])) {
    $urlProfilkes = $_GET['urlProfilkes'];
    $data = getWilayahProfilkes($urlProfilkes);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'URL Profilkes tidak ditemukan']);
}

// Fungsi untuk mendapatkan data subkategori dari API
function getWilayahProfilkes($urlProfilkes) {
    $url = "{$urlProfilkes}/api/kode_wilayah";
    $response = getData($url);
    return $response;
}

?>
