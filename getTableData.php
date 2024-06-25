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

function getTableData($kode_wilayah, $urlProfilkes, $tahun, $slug) {
    $url = "{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}";
    if ($kode_wilayah != '11') { // Assuming '11' is the code for Provinsi Aceh
        $url .= "&kode_wilayah={$kode_wilayah}";
    }

    return getData($url);
}

if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun']) && isset($_GET['slug'])) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slug'];

    $data = getTableData($kode_wilayah, $urlProfilkes, $tahun, $slug);
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Missing required parameters']);
}
?>
