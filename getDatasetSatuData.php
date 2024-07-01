<?php
if (isset($_GET['apiKey']) && isset($_GET['apiUrl']) && isset($_GET['uuid'])) {
    $apiKey = $_GET['apiKey'];
    $apiUrl = $_GET['apiUrl'];
    $uuid = $_GET['uuid'];
    $data = getData($apiKey, $apiUrl, $uuid);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'apiKey atau apiUrl tidak ditemukan']);
}

function getData($apiUrl, $apiKey, $uuid) {
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

    
    $responseData = json_decode($response, true);
    if (json_last_error()!== JSON_ERROR_NONE) {
    error_log("JSON decoding error: ". json_last_error_msg());
    return array('error' => 'JSON decoding Error');
    }
    return $responseData;
}
?>