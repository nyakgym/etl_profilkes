<?php
header('Content-Type: application/json');

// Fungsi untuk mendapatkan data dari API
function getData($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log('cURL error: ' . curl_error($ch));
        return array('error' => 'cURL error: ' . curl_error($ch));
    }
    curl_close($ch);
    return json_decode($response, true);
}

// Fungsi untuk mendapatkan data tabel dari API Profilkes
function getProfilkesData($kodeWilayah, $urlProfilkes, $tahun, $slug) {
    $url = "{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}";
    if ($kodeWilayah != '11') { // kode wilayah prov aceh = 11
        $url .= "&kode_wilayah={$kodeWilayah}";
    }
    return getData($url);
}

// Fungsi untuk mendapatkan data tabel dari API SatuData
function getSatuData($apiKey, $apiUrl, $uuid) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "{$apiUrl}/api/v1.1/datasets/{$uuid}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'APIKEY: ' . $apiKey
        ),
    ));
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        error_log('cURL error: ' . curl_error($curl));
        return array('error' => 'cURL error: ' . curl_error($curl));
    }
    curl_close($curl);
    return json_decode($response, true);
}

// Mengecek apakah parameter diperlukan ada dalam permintaan GET
if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes']) && isset($_GET['tahun']) && isset($_GET['slug']) && isset($_GET['uuid']) && 
    isset($_GET['apiUrl']) && isset($_GET['apiKey']) && isset($_GET['profilkesColumn']) && isset($_GET['satuDataColumn'])) {
    $kodeWilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slug'];
    $uuid = $_GET['uuid'];
    $apiUrl = $_GET['apiUrl'];
    $apiKey = $_GET['apiKey'];
    $profilkesColumn = $_GET['profilkesColumn'];
    $satuDataColumn = $_GET['satuDataColumn'];

    if (count($profilkesColumn) !== count($satuDataColumn)) {
        echo json_encode(['error' => 'Panjang kolom yang dipilih pada Profilkes dan SatuData harus sama.']);
        exit;
    }
    
    $profilkesData = getProfilkesData($kodeWilayah, $urlProfilkes, $tahun, $slug);
    $satuDataResponse = getSatuData($apiKey, $apiUrl, $uuid);

    if (isset($profilkesData['error']) || isset($satuDataResponse['error'])) {
        echo json_encode(['error' => 'Failed to fetch data from one or more sources']);
        exit;
    }

    $matchedData = matchAndMapColumns($profilkesData, $satuDataResponse, $profilkesColumn, $satuDataColumn);
    echo json_encode(['matchedData' => $matchedData]);
} else {
    echo json_encode(['error' => 'Missing required parameters']);
}

function matchAndMapColumns($profilkesData, $satuData, $profilkesColumn, $satuDataColumn) {
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
