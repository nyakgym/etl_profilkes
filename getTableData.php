<?php
// Fungsi untuk mendapatkan data tabel berdasarkan variabel
// function getTableData($apiUrlInput, $apiKeyInput, $var_id = null) {
//     if ($var_id !== null) {
//         $url = "$apiUrlInput/v1/api/list/model/data/lang/ind/domain/1100/var/{$var_id}/key/$apiKeyInput/";
//     } else {
//         $url = "$apiUrlInput/v1/api/list/model/var/lang/ind/domain/1100/key/$apiKeyInput/";
//     }
//     return getData($url);
// }

// function getData($url) {
//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $response = json_decode(curl_exec($ch), true);
//     curl_close($ch);
//     $result['success'] = $response['status'];
//     if ($response['status'] === 'OK') {
//         $result['data'] = $response['datacontent'];
//         $result['vervar'] = $response['vervar']; // tambahkan label var untuk unit (satuan)
//         $result['tahun'] = $response['tahun']; // tambahkan tahun
//         $result['labelvar'] = $response['labelvervar']; //tambahkan labelvar
//         $result['var'] = $response['var']; // tambahkan variabel
//     } else {
//         $result['error'] = $response['error'];
//     }
//     return $result;
// }

// $apiUrlInput = isset($_GET['apiUrlInput']) ? $_GET['apiUrlInput'] : '';
// $apiKeyInput = isset($_GET['apiKeyInput']) ? $_GET['apiKeyInput'] : '';
// // Panggil fungsi untuk mendapatkan data tabel
// $tableData = getTableData($apiUrlInput, $apiKeyInput, $_GET['var_id']);

// // Cek apakah data berhasil didapatkan
// if ($tableData['success'] && !empty($tableData['data'])) {
//     $response = array(
//         'success' => true,
//         'data' => $tableData['data'],
//         'vervar' => $tableData['vervar'],
//         'tahun' => $tableData['tahun'],
//         'var' => $tableData['var']
//     );
//     echo json_encode($response);
// } else {
//     echo json_encode(array('success' => false, 'message' => 'Tidak ada data yang tersedia untuk ditampilkan.'));
// }

?>