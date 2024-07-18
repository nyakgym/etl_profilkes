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

// Fungsi untuk mendapatkan data tabel dari API
function getTableData($kode_wilayah, $urlProfilkes, $tahun, $slug) {
    $url = "{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}";
    if ($kode_wilayah != '11') { // kode wilayah prov aceh = 11
        $url .= "&kode_wilayah={$kode_wilayah}";
    }
    return getData($url);
}

// Mengecek apakah parameter 'kode_wilayah', 'urlProfilkes', 'tahun', 'satuanProfilkes', dan 'slug' ada dalam permintaan GET
if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun']) && isset($_GET['satuanProfilkes']) && isset($_GET['slug'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $satuanProfilkes = $_GET['satuanProfilkes'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slug'];

    $data = getTableData($kode_wilayah, $urlProfilkes, $tahun, $slug);
    foreach ($data as &$row) {
        $row['satuan'] = $satuanProfilkes; // Tambahkan nilai satuanProfilkes ke setiap baris data
    }
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Missing required parameters']);
}
?>
