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

// Fungsi untuk mendapatkan data dataset dari API
function getDataset($kode_wilayah, $urlProfilkes, $tahun, $slug) {
    if (empty($slug)) {
        return []; // Kembalikan array kosong jika slug kosong
    }
    
    if ($kode_wilayah == '11') { // Assuming '11' is the code for Provinsi Aceh
        $url = "{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}";
    } else {
        $url = "{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}&kode_wilayah={$kode_wilayah}";
    }
    $response = getData($url);
    return $response;
}

if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun']) && isset($_GET['slug'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slug'];
    
    $data = getDataset($kode_wilayah, $urlProfilkes, $tahun, $slug);
    echo json_encode($data);
} else {
    echo json_encode([]); // Kembalikan array kosong daripada pesan error
}
?>