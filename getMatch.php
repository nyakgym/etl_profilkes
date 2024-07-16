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
    $profilkesColumn = explode(',', $_GET['profilkesColumn']); // Konversi kembali ke array
    $satuDataColumn = explode(',', $_GET['satuDataColumn']);   // Konversi kembali ke array

    if (empty($profilkesColumn) || empty($satuDataColumn)) {
        echo json_encode(['error' => 'Kolom dataset tidak boleh kosong']);
        exit;
    }

    if (count($profilkesColumn) !== count($satuDataColumn)) {
        echo json_encode(['error' => 'Banyak Kolom yang dipilih pada Dataset Profilkes dan SatuData harus sama.']);
        exit;
    }

    $profilkesData = getProfilkesData($kodeWilayah, $urlProfilkes, $tahun, $slug);
    $satuDataResponse = getSatuData($apiKey, $apiUrl, $uuid);

    if (isset($profilkesData['error']) || isset($satuDataResponse['error'])) {
        echo json_encode(['error' => 'Gagal mengambil data dari satu atau beberapa kolom dataset']);
        exit;
    }

    $matchedData = matchAndMapColumns($profilkesData, $satuDataResponse['data'], $profilkesColumn, $satuDataColumn);
    echo json_encode(['matchedData' => $matchedData]);
} else {
    echo json_encode(['error' => 'Missing required parameters']);
}

// mencocokkan kolom dari dua dataset berdasarkan kolom yang dipilih.
function matchAndMapColumns($profilkesData, $satuData, $profilkesColumn, $satuDataColumn) {
    $matchedData = [];
    $length = min(count($profilkesData), count($satuData));
    for ($i = 0; $i < $length; $i++) {
        $mappedRow = [];
        for ($j = 0; $j < count($profilkesColumn); $j++) {
            if (isset($profilkesData[$i][$profilkesColumn[$j]]) && isset($satuData[$i][$satuDataColumn[$j]])) {
                $mappedRow['profilkes'][$profilkesColumn[$j]] = $profilkesData[$i][$profilkesColumn[$j]];
                $mappedRow['satuData'][$satuDataColumn[$j]] = $satuData[$i][$satuDataColumn[$j]];
            }
        }
        $matchedData[] = $mappedRow;
    }
    return $matchedData;
}
?>
