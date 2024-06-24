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

function getSlug($kode_wilayah, $urlProfilkes, $tahun) {
    $url = "{$urlProfilkes}/api/slugs/?tahun={$tahun}";
    if ($kode_wilayah != '11') { // Assuming '11' is the code for Provinsi Aceh
        $url .= "&kode_wilayah={$kode_wilayah}";
    }
    $response = getData($url);
    return $response;
}

if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    
    $data = getSlug($kode_wilayah, $urlProfilkes, $tahun);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'Kode wilayah, tahun atau URL Profilkes tidak ditemukan']);
}

?>
