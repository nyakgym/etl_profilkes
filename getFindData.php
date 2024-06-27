<?php

function getData($apiKey, $apiUrl, $findNameInput){
    header('Content-Type: application/json');
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl.'api/v1.1/datasets/list/?limit=10&page=0&search='.$findNameInput,
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
if (isset($_GET['apiKey']) && isset($_GET['apiUrl']) && isset($_GET['findNameInput'])) {
    $apiKey = $_GET['apiKey'];
    $apiUrl = $_GET['apiUrl'];
    $findNameInput = $_GET['findNameInput'];
    $data = getData($apiKey, $apiUrl, $findNameInput);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'apiKey atau apiUrl tidak ditemukan']);
}


?>