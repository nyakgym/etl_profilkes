<?php

// Fungsi untuk melakukan request ke API dan mendapatkan data JSON
function getData($url) {
    $ch = curl_init($url); // Inisialisasi curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set opsi curl
    $response = json_decode(curl_exec($ch)); // Eksekusi curl dan parsing respons JSON
    curl_close($ch); // Tutup curl
    // // Set status sukses atau tidak
    // $result['success'] = $response->status;
    // // Jika respons sukses, simpan data
    // if ($response->status) {
    //     $result['data'] = $response->data;
    // } else {
    //     $result['data'] = $response->error;
    // }
    return $response;
    header('Content-Type: application/json');

    // if ($result['success'] && isset($result['data'][1])) {
    //     echo json_encode(array('success' => true, 'data' => $result['data'][1]));
    // } else {
    //     echo json_encode(array('success' => false, 'message' => 'Tidak ada data subkategori'));
    // }
}

// Fungsi untuk mendapatkan data subkategori dari API
function getWilayahProfilkes($urlProfilkes) {
    $url = "{$urlProfilkes}/api/kode_wilayah/";
    $response = getData($url);
    return $response;
}

$urlProfilkes = isset($_GET['urlProfilkes']) ? $_GET['urlProfilkes'] : '';
getWilayahProfilkes($urlProfilkes);

?>