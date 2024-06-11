<?php
// Fungsi untuk mendapatkan data dari API
function getData($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $response;
}

// Fungsi untuk mendapatkan data subjek dari API
function getTahun($tahun, $urlProfilkes) {
    // URL API yang sesuai
    $url = "{$urlProfilkes}/api/tahun={$tahun}/";
    $response = getData($url);
    return $response;
    // Ambil data dari API
    
    // if (isset($data['status']) && $data['status'] == 'OK') {
    //     echo json_encode(array('success' => true, 'data' => $data['data'][1]));
    // } else {
    //     echo json_encode(array('success' => false, 'message' => 'Tidak ada data subjek ditemukan.'));
    // }
}
if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $tahun = $_GET['tahun'];
    $data = getTahun($tahun, $urlProfilkes);
    if (isset($data['status']) && $data['status'] == 'OK') {
        echo json_encode(array('success' => true, 'data' => $data['data'][1]));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Tidak ada data tahun ditemukan.'));
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Tahun tidak ditemukan']);
}
// // Panggil fungsi untuk mendapatkan data subjek
// $kode_wilayah = isset($_GET['kode_wilayah']) ? $_GET['kode_wilayah'] : '';
// $urlProfilkes = isset($_GET['urlProfilkes']) ? $_GET['urlProfilkes'] : '';
// getTahun($kode_wilayah, $urlProfilkes);
?>