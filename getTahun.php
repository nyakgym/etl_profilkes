<?php

header('Content-Type: application/json');

// Fungsi untuk mendapatkan data dari API
function getData($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $response;
}

// Fungsi untuk mendapatkan data tahun dari API
function getTahun($kode_wilayah, $urlProfilkes) {
    $url = "{$urlProfilkes}/api/tahun?kode_wilayah={$kode_wilayah}";
    $response = getData($url);
    return $response;
}

if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $data = getTahun($kode_wilayah, $urlProfilkes);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'Kode wilayah atau URL Profilkes tidak ditemukan']);
}

?>
