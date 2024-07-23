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

// Fungsi untuk mendapatkan data dari SatuData
function getSatuData($apiUrl, $uuid, $apiKey) {
    $url = "{$apiUrl}/api/v1.1/datasets/{$uuid}";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'APIKEY: ' . $apiKey,
        'Content-Type: application/json'
    ));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $response;
}

// Mengecek apakah parameter yang diperlukan ada dalam permintaan GET
if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun']) && isset($_GET['slug']) &&
    isset($_GET['uuid']) && isset($_GET['apiUrl']) && isset($_GET['apiKey']) && isset($_GET['profilkesColumn']) && isset($_GET['satuDataColumn'])) {

    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slug'];
    $uuid = $_GET['uuid'];
    $apiUrl = $_GET['apiUrl'];
    $apiKey = $_GET['apiKey'];
    $profilkesColumn = explode(',', $_GET['profilkesColumn']);
    $satuDataColumn = explode(',', $_GET['satuDataColumn']);

    $profilkesData = getTableData($kode_wilayah, $urlProfilkes, $tahun, $slug);
    $satuData = getSatuData($apiUrl, $uuid, $apiKey);

    // Gabungkan data berdasarkan kolom yang dipilih
    $result = [];
    foreach ($profilkesData as $index => $profilkesRow) {
        $resultRow = [];
        foreach ($profilkesColumn as $col) {
            $resultRow[$col] = isset($profilkesRow[$col]) ? $profilkesRow[$col] : '';
        }
        foreach ($satuDataColumn as $col) {
            $resultRow[$col] = isset($satuData['data']['fields'][$index][$col]) ? $satuData['data']['fields'][$index][$col] : '';
        }
        $result[] = $resultRow;
    }

    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Missing required parameters']);
}
?>
