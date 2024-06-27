<?php

function getData($apiKey, $apiUrl){
    header('Content-Type: application/json');
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl.'api/v1.1/datasets/list/',
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
    curl_close($curl);
    return $response;
}

// Mengecek apakah parameter 'apiKey' dan 'apiUrl' ada dalam permintaan GET
if (isset($_GET['apiKey']) && isset($_GET['apiUrl'])) {
    $apiKey = $_GET['apiKey'];
    $apiUrl = $_GET['apiUrl'];
    $data = getData($apiKey, $apiUrl);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'apiKey atau apiUrl tidak ditemukan']);
}
?>