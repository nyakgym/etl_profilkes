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

// Fungsi untuk mendapatkan data tahun dari API
function getTahun($kode_wilayah, $urlProfilkes, $slug, $tahun) {
    if($kode_wilayah=='Provinsi Aceh'){
        // https://profilkes.acehprov.go.id/api/data/?slug={slug-dataset}&tahun={yyyy}
        $url = `{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}`;
        $response = getData($url);
        return $response;
    } else{
        // https://profilkes.acehprov.go.id/api/data/?slug={slug-dataset}&tahun={yyyy}&kode_wilayah={pp.kk}
        $url = `{$urlProfilkes}/api/data/?slug={$slug}&tahun={$tahun}&kode_wilayah={$kode_wilayah}`;
        $response = getData($url);
        return $response;
    }
}

if (isset($_GET['kode_wilayah']) && isset($_GET['urlProfilkes'] )) {
    $kode_wilayah = $_GET['kode_wilayah'];
    $tahun = $_GET['tahun'];
    $urlProfilkes = $_GET['urlProfilkes'];
    $slug = $_GET['slugs'];
    $data = getTahun($kode_wilayah, $urlProfilkes, $tahun);
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'Kode wilayah atau URL Profilkes tidak ditemukan']);
}

?>
