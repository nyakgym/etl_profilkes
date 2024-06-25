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
    return getData($url);
}

function getDataset($kode_wilayah, $urlProfilkes, $tahun, $slug) {
    if ($kode_wilayah == '11') { // Assuming '11' is the code for Provinsi Aceh
        $url = "{$urlProfilkes}/api/dataset?tahun={$tahun}";
    } else {
        $url = "{$urlProfilkes}/api/dataset?tahun={$tahun}&kode_wilayah={$kode_wilayah}";
    }
    return getData($url);
}

if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    
    // Ambil slug terlebih dahulu jika bukan Aceh
    if ($kode_wilayah != '11') {
        $slugData = getSlug($kode_wilayah, $urlProfilkes, $tahun);
        $slug = !empty($slugData['slug']) ? $slugData['slug'] : '';
    } else {
        $slug = '';
    }
    
    // Ambil dataset berdasarkan slug (jika bukan Aceh) atau hanya tahun (jika Aceh)
    $datasets = getDataset($kode_wilayah, $urlProfilkes, $tahun, $slug);
    
    // Kembalikan dataset dalam satu respon
    echo json_encode($datasets);
} else {
    echo json_encode([]);
}

?>
