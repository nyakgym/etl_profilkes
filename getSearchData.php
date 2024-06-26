<?php
    // $curl = curl_init($apiUrl);

    // curl_setopt_array($curl, [
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTPHEADER => [$apiKey],
    // ]);

    // $response = curl_exec($curl);
    // console.log($response);
    // curl_close($curl);
    // echo $response;
header('Content-Type: application/json');

// Fungsi untuk mendapatkan data dari API
function Data($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $response;
}

// Fungsi untuk mendapatkan data tahun dari API
function getSearchData($apiKey, $apiUrl) {
    $url = "{$apiUrl}/";
    $response = getData($url);
    return $response;
}
if (isset($_GET['apiKey']) && isset($_GET['apiUrl'])) {
    $apiKey = $_GET['apiKey'];
    $apiUrl = $_GET['apiUrl'];
    $data = getSearchData($apiKey, $apiUrl);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'api atau URL tidak ditemukan']);
}
?>