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

// Fungsi untuk mendapatkan data tabel dari API SatuData
function getSatuData($apiKey, $apiUrl, $uuid) {
    header('Content-Type: application/json');
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl.'/api/v1.1/datasets/'.$uuid,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'APIKEY: '.$apiKey
    ),
    ));
    $response = json_decode(curl_exec($curl), true);

    
    if (json_last_error()!== JSON_ERROR_NONE) {
    error_log("JSON decoding error: ". json_last_error_msg());
    return array('error' => 'JSON decoding Error');
    }
    return $response;
}

// Mengecek apakah parameter diperlukan ada dalam permintaan GET
if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun']) && isset($_GET['slug']) &&
    isset($_GET['uuid']) && isset($_GET['apiUrl']) && isset($_GET['apiKey']) &&
    isset($_GET['profilkesColumn']) && isset($_GET['satuDataColumn'])) {

    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slug'];
    $uuid = $_GET['uuid'];
    $apiUrl = $_GET['apiUrl'];
    $apiKey = $_GET['apiKey'];
    $profilkesColumn = $_GET['profilkesColumn'];
    $satuDataColumn = $_GET['satuDataColumn'];

    $profilkesData = getTableData($kode_wilayah, $urlProfilkes, $tahun, $slug);
    $satuData = getSatuData($apiKey, $apiUrl, $uuid);

    // Implement logic to match and map columns
    $matchedData = matchAndMapColumns($profilkesData, $satuData, $profilkesColumn, $satuDataColumn);
    echo json_encode(['matchedData' => $matchedData]);
} else {
    echo json_encode(['error' => 'Missing required parameters']);
}

function matchAndMapColumns($profilkesData, $satuData, $profilkesColumn, $satuDataColumn) {
    // Implement logic to match and map columns
    $matchedData = [];
    
    $length = min(count($profilkesData), count($satuData['data']));
    for ($i = 0; $i < $length; $i++) {
        $matchedData[] = [
            'profilkes' => $profilkesData[$i][$profilkesColumn],
            'satuData' => $satuData['data'][$i][$satuDataColumn]
        ];
    }

    return $matchedData;
}
?>
